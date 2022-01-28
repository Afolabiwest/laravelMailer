<html>
<head>
	<title># laravelMailer</title>
</head>
<body>

<h1># USAGE</h1>


<h3># In the controller</h3>
<pre>
&lt;?php

...
use App\LaravelMailer\LaravelMailer

class UserController extends Controller
{
    /*
    Make sure you configure the config/mail.php appropriately
    if you will not be supllying the @param $senderEmail ='' and @param  $senderName
     optional arguments
    */
    public function sendMail(Request $request)
    {
        $receiver = 'some.receiver@example.com'; // Receiver email address. Can be form the $request object
        $data = (object) [ // Key: value pair assoc array of data to be stitched to the mail blade template
            ...
        ];
        $view = 'mails.mail_template'; // laravl blade template in the resources/views folder
        $senderEmail ='sender@compnay.com'; // Optional
        $senderName ='Sender Company Dept'; // Optional
        LaravelMailer::postMail($receiver, $data, $view, $senderEmail ='', $senderName ='' );
    }
}

</pre>

<h3># In the routes/web.php or routes/api.php</h3>

<pre>

&lt;?php

Route::post('/send-mail-endpoint', 'UserController@sendMail')->name('mail.endpoint.send');


</pre>


</body>
</html>



