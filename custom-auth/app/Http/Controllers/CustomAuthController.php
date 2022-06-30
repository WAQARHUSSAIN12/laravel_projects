<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Mail;

class CustomAuthController extends Controller
{
   public function registeration(){
    return view("auth.registeration");
   }

   public function login(){
    return view("auth.login");
   }

   public function customRegister(Request $req){
   
    $req->validate([
           "name" => "required",
           "email" => "required|email|unique:users",
           "password" => "required"
       ]);

       $user = new User();
       $user->name =  $req->name;
       $user->email =  $req->email;
       $user->password =  Hash::make($req->password);
       $res = $user->save();
       if($res){
        return back()->with("success","User registered successfully");
       }else{
        return back()->with("fail","User not registerd");
       }
   }

   public function customLogin(Request $req){

        $req->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user =  User::where("email","=",$req->email)->first();
        if($user){
            if(Hash::check($req->password, $user->password)){
                echo "Hello" ; 
                session()->put("loginId", $user->id);
                return redirect("dashboard");
            }else{
                return back()->with("fail","Password not match");
            }
        }else{
            return back()->with("fail","User not found with this email");
        }
   }

   public function dashboard(){
        $userId = session("loginId");
        $data =  User::where("id","=",$userId)->first();
        return view("dashboard",compact("data"));
   }
   
   public function logout(){
       if(session::has("loginId")){
           session::pull("loginId");
            return redirect()->route("login");
       }
   }

   public function orders(){
       return "Orders";
   }

   public function customers(){
    return "Customers";
   }

   public function reports(){
        return "Reports";
   }

   public function forgetPassword(){
       return view("auth.forgetpassword");
   }

   public function customForgetPassword(Request $req){
       
        $req->validate([
            "email" => "required|email"
        ]);

        $user =  User::where("email","=",$req->email)->first();
        $verifyLink = random_int(100000,500000);
        session()->put("verifyLink",$verifyLink); 

        $data = [
                "name" => $user->name, 
                "link" => $verifyLink,
                "email" => $user->email
            ];

        // send plan text email 
        // Mail::send(['text'=>'mail'], $data, function($message) {
        // $message->to('vagohab123@minimeq.com', 'Email forget email')
        // ->subject('Laravel Basic Testing Mail');
        // $message->from('wakkar12@gmail.com','Waqar Gandhi');
        // });


        // send email with attachments
        // public function attachment_email() {
        //     $data = array('name'=>"Virat Gandhi");
        //     Mail::send('mail', $data, function($message) {
        //        $message->to('abc@gmail.com', 'Tutorials Point')->subject
        //           ('Laravel Testing Mail with Attachment');
        //        $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
        //        $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
        //        $message->from('xyz@gmail.com','Virat Gandhi');
        //     });
        //     echo "Email Sent with attachment. Check your inbox.";
        //  }

        // send email with html tags
        
        Mail::send('mail',$data, function($message) {
            $message->to('vagohab123@minimeq.com', 'Forget password email')
            ->subject('Forget password email');
            $message->from('wakkar12@gmail.com','Easy Buy');
            });

            echo "Basic Email Sent. Check your inbox.";
    }

//    public function basic_email() {
//     $data = array('name'=>"Virat Gandhi");
 
//     Mail::send(['text'=>'mail'], $data, function($message) {
//        $message->to('abc@gmail.com', 'Tutorials Point')->subject
//           ('Laravel Basic Testing Mail');
//        $message->from('xyz@gmail.com','Virat Gandhi');
//     });
//     echo "Basic Email Sent. Check your inbox.";
//  }

public function verifyLink($link,$email){

    // echo  "your verfy code id " . $link;
    // echo  "your verfy code id " . $email;
    // echo  "<br> your verfy code id " . session("verifyLink");

    if($link == session("verifyLink")){
        $user =  User::where("email", "=" , $email)->first();
        return view("auth.forgetpasswordform",['user'=>$user]);
    }else{
         redirect()->route("login");
    }
}

public function updatePassword(Request $req){

    $req->validate([
        'password' => 'required',
        'password_confirmation' => 'required_with:password|same:password',
        "email" => "required|email"
    ]);

    $user =  User::where("email","=",$req->email)->first();

    $user->password = Hash::make($req->password);
    $user->email = $req->email;
    $res =  $user->save();
    if( $res){
        echo "Updated";
    }else{
        echo "Updated";
    }
    return $req->all();
}

}