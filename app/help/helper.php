<?php

use App\Models\User;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use App\Models\Notification;

// This Function tO return bool value ( true Or False ) if has this permission or not

function hasRole($roleNumber, $source = null)
{
    $source = ($source == null) ? @Auth::guard('admins')->user()->group->permissions : $source;
    $exp = explode('|', $source);

    if (in_array($roleNumber, $exp)) {
        return true;
    }

    return false;
}

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    /*   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       curl_setopt($curl, CURLOPT_USERPWD, "username:password");*/

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function returnTimeZoneByIpAdd()
{

    $timeZone = (array)json_decode(CallAPI('post', 'https://ipfind.co?ip=' . $_SERVER['REMOTE_ADDR']));

    // Return Valid Value
    if (array_key_exists('error', $timeZone) == false) {

        $zoneList = timezone_identifiers_list(); # list of (all) valid timezones
        if (in_array($timeZone['timezone'], $zoneList)) {
            return $timeZone['timezone'];
        }
    } else {
        return config('app.timezone');
    }

}

function returnIfNull($anyThing)
{

    if (is_null($anyThing)) {
        abort('404');
    }

    return true;
}

// This Function For check permission
function ifHasAccess($roleNumber)
{
    if (!hasRole($roleNumber)) {
        abort('401');
    }
    return true;
}

function _fireSMS($phoneNumber, $msg)
{
    return true;
}

function getSession()
{
    if (Session::get('local') !== 'en') {
        return 0; // Session Is Arabic
    }
    return 1;  // Session Is English
}

function setRedirectWithMsg($case, $redirectPath, $msg = null, $alertType = 'success', $icon = 'check')
{
    if ($case == 'create') {

        if (getSession() == 0) {
            $msg = '  تمت الإضافة بنجاح .';
        } else {
            $msg = '  Data Has Been Added Successfully .';
        }
    } elseif ($case == 'update') {
        // If Case Update
        if (getSession() == 0) {
            $msg = '  تم حفظ التعديلات بنجاح .';
        } else {
            $msg = '  Data Has Been Updated Successfully .';
        }
    } elseif ($case == 'other') {

        // If Case Other
        if (getSession() == 0) {
            $msg = '  تمت العملية بنجاح .';
        } else {
            $msg = '  Operation Has Been Done Successfully .';
        }

    } else {
        // Case Delete
        if (getSession() == 0) {
            $msg = '  تم الحذف بنجاح .';
        } else {
            $msg = '  Data Has Been Deleted Successfully .';
        }
    }

    if ($redirectPath == 'back()') {
        return $redirect = redirect()->back()->with(['msg' => $msg]);
    }
    //alert()->success($msg);
    return $redirect = redirect()->to(Url('/') . '/' . $redirectPath)->with(['msg' => $msg]);
}


function getLang()
{
    app()->setLocale(\Session::get('local'));
    return app()->getLocale();
}

function pushNotification($translationKey,$replace,$users,$typeThisNotify,$redirectionID,$type,$adminId)
{
    $ob = [
        'body_ar'        => trans('notifications.'.$translationKey,$replace,'ar'),
        'body_en'        => trans('notifications.'.$translationKey,$replace,'en'),
        'type'           => $type,
        'notify_type'    => $typeThisNotify,
        'redirect_id'    => $redirectionID,
        'admin_id'       => $adminId,
    ];
    $notificationObject = Notification::create($ob);
    foreach ($users as $user) {
        $notificationObject->users()->create(['user_id' => $user->id]);
        if ($user->send_notifications && $user->firebase_token != null){
            $data = [
                'title'         => '',
                'body'          => $user->current_lang === 'ar' ? $notificationObject->body_ar : $notificationObject->body_en,
                'notify_type'   => $typeThisNotify,
                'redirect_id'   => $redirectionID,
            ];
            notify('', $data['body'], $data, $user);
        }
    }
}

function notify($title, $body, $json_data, $user)
{
    try {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 50);
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)->setSound('default');
        $optionBuilder->setDelayWhileIdle(true);
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($json_data);
        $option = $optionBuilder->build();
        $notificationBuilder->build();
        $data = $dataBuilder->build();
        if ($user->device_type == 0) {
            $downstreamResponse = \LaravelFCM\Facades\FCM::sendTo($user->firebase_token,$option,null,$data);
        } else {
            $downstreamResponse = notifyIOS($data,$user->firebase_token);
        }
        return true;
    } catch (\Exception $exception) {
        return false;
    }
}

function notifyIOS($data, $user_token)
{
    $body = array(
        "to"           => $user_token,
        "priority"     => "high",
        "badge"        => "true",
        "notification" => array_merge($data->toArray(),["sound" => 'true']),
    );
    $body = json_encode($body);
    $headers = array('Content-Type:application/json', "Authorization:key=".env('FCM_SERVER_KEY'));
    $ret = FCMCurl($body, $headers);
    return $ret;
}

function FCMCurl($body, $headers)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}

