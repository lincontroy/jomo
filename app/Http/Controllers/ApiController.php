<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepositModel;
use App\Models\DepositsModel;
use App\Models\User;
use App\Models\Sessions;
use App\Models\Activations;
use App\Models\Deposits;
use App\Models\Logs;

class ApiController extends Controller
{
    //
    
    
        
     public function sendingmessage($post){
        
        $ch = curl_init('https://graph.facebook.com/v15.0/108999672054397/messages'); // Initialise cURL
        
        $post = json_encode($post);
        
        $authorization = "Authorization: Bearer EAANOaA7BVH0BAGmQMl7XfaMcYc6flVUHoPasZAOPQRqnNpJzeYyFhwRWm2FG2CDrNVoZBf5GIZAXy6ZCn6IF9HvCErU2xaWIt2CjIOyYJo9PqXJeVTTXTX0yEKJZB4UvYbZClHDh0iWq2StyF4W2bw8r2PDJooCRl9YKI7STn2Gb5oj35phcLrZAH05ewTT5cEIIWoPH3ZCIwAZDZD";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        $result = curl_exec($ch);
        
        curl_close($ch);
        
        return json_decode($result);
     }
     public function whatsapp(Request $request){
         
       
        
            $menu1="Welcome to Jomo Enterprises,We are here for you!\n\n1. Reply with 1 if you're our direct dealer\n2. Reply with 2 if you're a retailer/Duka/Wholesale\n3. Reply with 3 if your're a consumer\n\nPlease check back soon as we regularly introduce new functionality";
            $menu2="1. Reply with 1 to get price List\n2. Reply with 2 to speak with an agent in this chat";
            $menu3="Thank you\n1. Reply with 1 to get price List\n2. Reply with 2 to speak with an agent in this chat\n3. Reply with 3 to get distributor near you";
            $menu4="1. Reply with 1 to view our Product List or catalogue\n2. Reply with 2 to speak with an agent in this chat";
            $contactmessage="Someone will get in touch with you shortly";
            
            $arr=$request;
            
           
            
            //check if isset entry
            
            if(isset($arr->entry)){
                
                $entry=$arr->entry;
                 
                $message=$entry[0]['changes'][0]['value']['messages'][0]['text']['body'];
                
                $name=$entry[0]['changes'][0]['value']['contacts'][0]['profile']['name'];
                
                $mobile=$entry[0]['changes'][0]['value']['contacts'][0]['wa_id'];
                
                //check if the mobile has an active session
                
                $check=Sessions::where('mobile',$mobile)
                ->where('status',0)
                ->first();
                
                if(!$check){
                    
                    //create a new session
                    
                    $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>$menu1
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            
                    $create_a_session=new Sessions();
                    
                    $create_a_session->mobile=$mobile;
                    
                    $create_a_session->asked1=1;
                    
                    $create_a_session->status=0;
                    
                    $create_a_session->save();
                    
                    
                            
                    
                }else{
                    //check if option 1 is null
                    
                    if($check->status==0){
                        
                        if($check->option1==null && $check->asked1==1){
                            
                            //send the second menu
                            
                            //check for the response and update
                            
                            if($message==1){
                                
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>$menu2
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            
                            Sessions::where('mobile',$mobile)->update(['option1'=>$message,'asked2'=>1]);
                            
                            }else if($message==2){
                                
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>$menu3
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            
                            Sessions::where('mobile',$mobile)->update(['option1'=>$message,'asked2'=>1]);
                                
                                
                            }else if($message==3){
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>$menu4
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            
                            Sessions::where('mobile',$mobile)->update(['option1'=>$message,'asked2'=>1]);
                            }else{
                                
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"Invalid option, start over!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            
                            
                            
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                            
                                
                            }
                            
                            
                            
                        }else if($check->option1==1 && $check->asked2==1){
                            
                            
                            //update option 1 and move to the next menu
                            Sessions::where('mobile',$mobile)->update(['option2'=>$message]);
                            
                            //ask the second option
                            
                            if($message==1){
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"Visit our website to get our price list. https://jomoent.co.ke!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                                
                            }else if($message==2){
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"We are notifying an agent about your request to chat, Thankyou for your patience, We look forward to chatting with you!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                            }else{
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"Invalid option! Start over!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                            
                            
                            }
                            
                            
                        }
                        //means there is an active session for this mobile number
                        else if($check->option1==2 && $check->asked2==1){
                            
                            
                            //update option 1 and move to the next menu
                            Sessions::where('mobile',$mobile)->update(['option2'=>$message]);
                            
                            //ask the second option
                            
                            if($message==1){
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"Use this Link to get to our website and view our prices\nhttps://jomoent.co.ke/prices"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                                
                            }else if($message==2){
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"We are notifying an agent about your request to chat, Thankyou for your patience, We look forward to chatting with you!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);}
                            
                            
                            else if($message==3){
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"We are notifying an agent about your request to chat, Thankyou for your patience, We look forward to chatting with you!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);}
                            
                            else{
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"Invalid option! Start over!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                            
                            }
                            
                            
                        }
                        
                        else if($check->option1==3 && $check->asked2==1){
                            
                            
                            //update option 1 and move to the next menu
                            Sessions::where('mobile',$mobile)->update(['option2'=>$message]);
                            
                            //ask the second option
                            
                            if($message==1){
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"Use this Link to get to our catalogue and view our prices\nhttps://jomoent.co.ke/catalogue"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                                
                            }else if($message==2){
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"We are notifying an agent about your request to chat, Thankyou for your patience, We look forward to chatting with you!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                            }else{
                                //send a message that someone will be in touch shortly
                                $array=['messaging_product'=>'whatsapp',
                                'recipient_type'=>'individual',
                                'to'=>$mobile,
                                'type'=>'text',
                                'text'=>[
                                    'body'=>"Invalid option! Start over!"
                                    ]
                                ];
                                
                            $this->sendingmessage($array);
                            Sessions::where('mobile',$mobile)->update(['status'=>1]);
                            
                            
                            }
                            
                            
                        }
                    }else{
                        
                         //means there is no active session for this mobile number
                         
                    }
                }
                
            
            
            //
            
            return $mobile;
            
            }else{
                
            }
            
            
            
            
            
            
                   
                    $logFile = "datah.txt";
                
                    $log = fopen($logFile, "a");
                    fwrite($log, $request);
                    fclose($log);
                   
                   
                   $challenge = $request->hub_challenge;
                   $verify_token = $request->hub_verify_token;
                    
                    if ($verify_token === 'qwertyuiop12345')
                    {
                        
                        echo $challenge;
                        $logFile = "messages.txt";
                    
                        $log = fopen($logFile, "a");
                        fwrite($log, $request);
                        fclose($log);
                         
                    }else{
                        $logFile = "another.txt";
                    
                        $log = fopen($logFile, "a");
                        fwrite($log, $request);
                        fclose($log);
                        // echo "qwertyuiop12345";
                        
                    }
                    
                    
                    
        
        
        
    }
    public function mpesa(Request $request){
        
        // log the response
    $logFile = "M_PESAConfirmationResponse.txt";
    
    $log = fopen($logFile, "a");
    
    fwrite($log, $request);
    
    fclose($log);
    
   
    $TransactionType     =  $request['TransactionType'];
    $TransID          =$request['TransID'];
    $TransTime           = $request['TransTime'];
    $TransAmount          = $request['TransAmount'];
    $BillRefNumber       = $request['BillRefNumber'];
    $InvoiceNumber       = $request['InvoiceNumber'];
    $ThirdPartyTransID   = $request['ThirdPartyTransID'];
    $MSISDN            = $request['MSISDN'];
    $FirstName          = $request['FirstName'];
    $MiddleName         = $request['MiddleName'];
    $LastName            = $request['LastName'];
    
    $Deposit = new DepositModel();
    
    $Deposit->TransactionType=$TransactionType;
    $Deposit->TransID=$TransID;
    $Deposit->TransTime=$TransTime;
    $Deposit->TransAmount=$TransAmount;
    $Deposit->BillRefNumber=$BillRefNumber;
    $Deposit->InvoiceNumber=$InvoiceNumber;
    $Deposit->ThirdPartyTransID=$ThirdPartyTransID;
    $Deposit->MSISDN=$MSISDN;
    $Deposit->FirstName=$FirstName;
    $Deposit->MiddleName=$MiddleName;
    $Deposit->LastName=$LastName;
    
    $Deposit->save();
    
    //check if the amount added by this guy is equal to activation fee
    $reg=env('reg_fee');
    $level1reward=env('level_one');
    $level2reward=env('level_two');
    
    $explode=explode("#",$BillRefNumber);

    $where=$explode[0];
    $user_id=$explode[1];
    if(($TransAmount == $reg) && ($where=='fpa')){
        //check if its activation fee and activate the user account
        
        
     
            //acount activation
            
            $update=User::where('id',$user_id)->update(['status'=>1]);
            $Activations=new Activations();
            
            $Activations->user_id=$user_id;
            $Activations->amount=$TransAmount;
            
            
            $Activations->save();
            
            if(($update) && ($Activations->save())){
                
                //check to see the upline of this guy and add cash to his wallet
                
                $level1uplinechecks=User::where('id',$user_id)->get('referal');
                
                foreach($level1uplinechecks as $level1uplinecheck){
                    
                    $leveloneuplinename=$level1uplinecheck->referal;
                    
                    //check the balance of this guy and add some cash to his wallet
                    
                    
                    $balances=User::where('name',$leveloneuplinename)->get();
                    
                    foreach($balances as $balance){
                        
                        $level1uplinebalance=$balance->balance;
                        
                        $newbalance=$level1uplinebalance+$level1reward;
                        
                        
                        $updater=User::where('name',$leveloneuplinename)->update(['balance'=>$newbalance]);
                        
                        
                           //level two awarding
                           
                           $leveltworefs=User::where('name',$leveloneuplinename)->get();
                           
                           
                           foreach($leveltworefs as $leveltworef){
                               
                               $level2uplinename=$leveltworef->referal;
                               
                               //check wallet balance of this guy
                               
                               $balances=User::where('name',$level2uplinename)->get();
                               
                               foreach($balances as $balance){
                                   
                                   $level2uplinebalance=$balance->balance;
                                   
                                   $newbalanceleveltwo=$level2uplinebalance+$level2reward;
                                   
                                   $updater=User::where('name',$level2uplinename)->update(['balance'=>$newbalanceleveltwo]);
                                   
                                   return response()->json(['message'=>'User activated','status'=>200]);
                                   
                               }
                           }
                              
                    }
                }
              }else
              {
                return response()->json(['message'=>'An error occured','status'=>500]);
            }
            
        
    }
    
    
        else{
        
        //fund this users account
        
        $users=User::where('id',$user_id)->get();
         
         foreach($users as $user){
             $user_balance=$user->balance;
             
             $new_balance=$user_balance + $TransAmount;
             
             $update=User::where('id',$user_id)->update(['balance'=>$new_balance]);
             
             
             $Deposits= new Deposits();
             
             $Deposits->user_id=$user_id;
             $Deposits->amount=$TransAmount;
             
             $Deposits->save();
             
             $logs=new Logs();
             
             $logs->activity="User added KES $TransAmount";
             
             $logs->user_id=$user_id;
             
             $logs->save();
             
             $message="Deposit of $TransAmount added";
             
             
             return response()->json(['message'=>$message,'status'=>200]);
  
         }    
  
        }
    
    }
}
