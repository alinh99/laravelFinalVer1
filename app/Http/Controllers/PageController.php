<?php

namespace App\Http\Controllers;

use App\AdminProduct;
use App\Icon;
use App\product;
use App\Cart;
use App\User;
use App\Bill;
use App\BillDetails;
use Illuminate\Http\Request;
use App\Slide;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Contacts;
use Illuminate\Support\Facades\Hash;
class PageController extends Controller
{
    //
    public function getIndex(){
        $slides =   Slide::where('id','<',6)->get();
        $slide_second = Slide::where('id', '>', 5)->get();
        $icons = Icon::all();
        $products = product::where('id','>',0)->paginate(3);
        // dd($products);
        $new_products = AdminProduct::all();
        return view('page.trangchu',compact('slides', 'slide_second', 'icons','products','new_products'));
    }

    public function getLienHe(){
        return view('page.lienhe');
    }

    public function getIndexAdmin(){
        $new_products = product::all();
        return view('Admin.admin')->with(['products'=>$new_products]);
    }

    public function postAdminDelete($id){
        $products = product::find($id);
        $products->delete();
        return $this->getIndexAdmin();
    }

    public function getAdminAdd(){
        return view('Admin.formAdd');
    }


    public function postAdminAdd(Request $request){
        $product = new product() ;
        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=$file->getClientOriginalName('image');
            $file->move('assets/img/',$fileName);
        }
        $file_name = null;
        if($request->file('image')!=null){
            $file_name=$request->file('image')->getClientOriginalName();
        }
        $product->title = $request->title;
        $product->image = $file_name;
        $product->price = $request->price;
        $product->save();
        return $this->getIndexAdmin();
    }


    public function getAdminEdit($id){
        $product = product::find($id);
        return view('Admin.formEdit')->with(['product'=>$product]);
    }

    public function postAdminEdit(Request $request){
        $id = $request->id;
        $product = product::find($id);
        if($request->hasFile('image')){
            $file = $request -> file('image');
            $fileName = $file -> getClientOriginalName('image');
            $file->move('assets/img/',$fileName);
        }
        if($request->file('image')!=null){
            $product->image=$fileName;
        }
        $product->title = $request->title;
        $product->price = $request->price;
        $product->save();
        return $this->getIndexAdmin();
    }

    public function AddCart(Request $req, $id){
        $product = product::where('id',$id)->first();

        if($product != null){
                $oldCart = session("Cart") ? session("Cart") : null;
                $newCart = new Cart($oldCart);
                $newCart->AddCart($product, $product->id);
                $req->session()->put('Cart', $newCart);
        }
        return view('page.cart');
    }

    public function DeleteItemCart(Request $req, $id){
        $oldCart = session("Cart") ? session("Cart") : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if(count($newCart->items) > 0){
            $req->session()->put('Cart', $newCart);
        }else{
            $req->session()->forget('Cart');
        }
        return view('page.cart');
    }

    public function ViewListCart(){
        return view('page.list');
    }

    public function DeleteListItemCart(Request $req, $id){
        $oldCart = session("Cart") ? session("Cart") : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if(count($newCart->items) > 0){
            $req->session()->put('Cart', $newCart);
        }else{
            $req->session()->forget('Cart');
        }
        return view('page.list-cart');
    }

    public function SaveListItemCart(Request $req, $id, $quanty){
        $oldCart = session("Cart") ? session("Cart") : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($id, $quanty);

        $req->session()->put('Cart', $newCart);

        return view('page.list-cart');
    }

    public function SaveAllListItemCart(Request $req){
        foreach($req->data as $item){
            $oldCart = session("Cart") ? session("Cart") : null;
            $newCart = new Cart($oldCart);
            $newCart->UpdateItemCart($item["key"], $item["value"]);
            $req->session()->put('Cart', $newCart);
        }
    }

    public function DeleteAllListItemCart(Request $req){
        foreach($req->data as $item){
            $oldCart = session("Cart") ? session("Cart") : null;
            $newCart = new Cart($oldCart);
            $newCart->UpdateItemCart($item["key"], $item["value"]);
        }
        $req->session()->forget('Cart');
    }

    public function ViewCheckOutCart(){
        return view('page.checkout');
    }

    public function postCheckout(Request $req){
        $cart = session()->get('Cart');

        // $this->validate($req, [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
        //     'note' => 'required',
        //     'address'=>'required',
        //  ]);

        $customer = new Customer;
        $customer->name = $req->full_name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->paymentMethod;
        $bill->note = $req->notes;
        $bill->save();

        foreach($cart->items as $key=>$value){
            $bill_detail = new BillDetails;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;//$value['item']['id'];
            $bill_detail->quantity = $value['quanty'];
            $bill_detail->price = $value['price']/$value['quanty'];
            $bill_detail->save();
        }
        session()->forget('Cart');
        return redirect()->back()->with('check-success','Đặt hàng thành công');
    }

    public function postLienHe(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'note' => ''
        ],
        [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'phone.required' => 'Vui lòng nhập mật khẩu',
            'phone.regex' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 kí tự'
        ]);

        $contacts = new Contacts;
        $contacts->name = $request->name;
        $contacts->email = $request->email;
        $contacts->phone_number = $request->phone;
        $contacts->note = $request->note;
        $contacts->save();
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

    public function getDangKi(){
        return view('page.dangki');
    }


    public function getDangNhap(){
        return view('page.dangnhap');
    }

    public function postDangKi(Request $req){
        $this->validate($req,
        [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ],
        [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất 6 kí tự'
        ]);
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = $req->password;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->save();
        return redirect()->back()->with('dangkithanhcong','Khởi tạo tài khoản thành công');
    }

    public function postDangNhap(Request $req){
        $this->validate($req,
        [
            'email' => 'required|email|',
            'password' => 'required|min:6|max:20',
        ],
        [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu có tối đa 20 kí tự'
        ]);

        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect()->back()->with(['flags'=>'success','message'=>'Đăng nhập thành công']);
        }else{
            return redirect()->back()->with(['flags'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }

    public function postDangXuat(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
}
