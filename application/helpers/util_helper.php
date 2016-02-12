<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
  
   function sendMail($main_subject, $second_subject, $sendto, $body_message, $callback_url)
   {
     require_once('webroot/mailer/PHPMailerAutoload.php');
    
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->Host = 'mail.wizcation.com';
      $mail->Port = 587;
      $mail->SMTPSecure = 'tls';
      $mail->SMTPAuth = true;
      $mail->Username = "info@wizcation.com";
      $mail->Password = "Info2015";
      $mail->setFrom('info@wizcation.com',$second_subject);
      $mail->addReplyTo('info@wizcation.com', $second_subject);
      $mail->addAddress($sendto, $main_subject);
      $mail->Subject = $main_subject;
      $mail->msgHTML($body_message);
  
      if (!$mail->send()) 
      {
        return false;
      } else {
         return true;
      }
   }
  
  function comment_star($id)
  {
    $output = '';
    if($id==1)
    {
      $output ='<div class="glyphicon glyphicon-star"></i>';
    }
    elseif($id==2)
    {
      $output ='<i class="glyphicon glyphicon-star"></i>';
      $output .='<i class="glyphicon glyphicon-star"></i>';
    }
    elseif($id==3)
    {
       $output ='<i class="glyphicon glyphicon-star"></i>';
       $output .='<i class="glyphicon glyphicon-star"></i>';
       $output .='<i class="glyphicon glyphicon-star"></i>';
    }
    elseif($id==4)
    {
       $output ='<i class="glyphicon glyphicon-star"></i>';
       $output .='<i class="glyphicon glyphicon-star"></i>';
       $output .='<i class="glyphicon glyphicon-star"></i>';
       $output .='<i class="glyphicon glyphicon-star"></i>';
    }
    elseif($id==5)
    {
       $output ='<i class="glyphicon glyphicon-star"></i>';
       $output .='<i class="glyphicon glyphicon-star"></i>';
       $output .='<i class="glyphicon glyphicon-star"></i>';
       $output .='<i class="glyphicon glyphicon-star"></i>';
        $output .='<i class="glyphicon glyphicon-star"></i>';
    }
    return $output;
  }

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  function display_room_title($room_code)
  {
      $ci =& get_instance();
      $ci->load->database();
      $query = $ci->db->get_where('accomodation',array('room_code'=>$room_code));
      if($query->num_rows() > 0)
      {
        $result = $query->row_array();
        return $result['title_name'];
      } else{
        return false;
      }
  }

  function timeAgo($timestamp)
  {
    $datetime1 =new DateTime("now");
    $datetime2 = date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    
    if($diff->y > 0){
        $timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');

    }
    else if($diff->m > 0){
     $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
    }
    else if($diff->d > 0){
     $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
    }
    else if($diff->h > 0){
     $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
    }
    else if($diff->i > 0){
     $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
    }
    else if($diff->s > 0){
     $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
    }

    $timemsg = $timemsg.' ago';
    return $timemsg;
  }

   function subtypeTitle($item_id)
   {
      $ci =& get_instance();
      $ci->load->database();
      $query = $ci->db->get_where('item_type',array('item_id'=>$item_id));
      
      if($query->num_rows() > 0)
      {
        $result = $query->row_array();
        return $result['item_name'];
      } else{
        return false;
      }
   }
 
    function multi_array_key_exists( $needle, $haystack ) { 

        foreach ( $haystack as $key => $value ) : 

            if ( $needle == $key ) 
                return true; 
            
            if ( is_array( $value ) ) : 
                 if ( multi_array_key_exists( $needle, $value ) == true ) 
                    return true; 
                 else 
                     continue; 
            endif; 
            
        endforeach; 
        
        return false; 
    } 
    
   function districtLocal($id)
   {
     $ci =& get_instance();
      $ci->load->database();
      $query = $ci->db->get_where('district_custom',array('id'=>$id));
      if($query->num_rows() > 0)
      {
        $result = $query->row_array();
        return $result['tumbol_name'];
      } else{
        return false;
      }
   }

   function districlocalHometome($tumbolKey, $tumbol_moo)
   {
      $ci =& get_instance();
      $ci->load->database();
      $query = $ci->db->get_where('district_local',array('tumbol_key'=>$tumbolKey, 'tumbol_moo' => $tumbol_moo ));
      if($query->num_rows() > 0)
      {
        $result = $query->row_array();
        return $result['tumbol_moo_name'];
      } else{
        return false;
      }
   }

   function amphurTitle($AMPHUR_ID)
   {
      $ci =& get_instance();
      $ci->load->database();
      $query = $ci->db->get_where('amphur',array('AMPHUR_ID'=>$AMPHUR_ID));
      if($query->num_rows() > 0)
      {
        $result = $query->row_array();
        return $result['AMPHUR_NAME'];
      } else{
        return false;
      }
   }

   function districtTitle($DISTRICT_ID)
   {
        $ci =& get_instance();
        $ci->load->database();
        $query = $ci->db->get_where('district',array('DISTRICT_ID'=>$DISTRICT_ID)); 
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return $result['DISTRICT_NAME'];
       }else{
           return false;
       }
   }

   function userGroup($groupId)
   {
     $ci =& get_instance();
        $ci->load->database();
        $query = $ci->db->get_where('user_group',array('id'=>$groupId)); 
       if($query->num_rows() > 0)
       {
           $result = $query->row_array();
           return $result['user_group'];
       }else{
           return false;
       }
   }

   function status_user_verify($status)
   {
      if($status==1)
      {
        echo "verify";
      }
      else
      {
        echo "not verify";
      }
   }

   function payment_status($status)
   {
     if($status ==0)
     {
      echo "Not paid";
     }
     else if($status==1)
     {
      echo "Paid";
     }
     else if($status==2)
     {
      echo "Trasaction rejected";
     }
   }


  function exchangeRate( $amount, $from, $to)
  {
    if(empty($to))
    {
      return $amount;
    }
    else
    {
        $amount = urlencode($amount);
        $from_Currency = urlencode($from);
        $to_Currency = urlencode($to);
        $get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=" . $from_Currency . "&to=" . $to_Currency);
        $get = explode("<span class=bld>",$get);
        $get = explode("</span>",$get[1]);
        $converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
        return round($converted_amount, 2);
    }
  }
  
  function status_user_guest($status)
  {
    if($status == 0)
    {
      return "Not paid";
    }
    else if($status== 1)
    {
      return "Paid";
    }
    else if($status==2)
    {
      return "Trasaction being rejected";
    }
  }

  



