<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use SoapClient;
use SoapVar;
use SoapHeader;
use stdClass;

class SoapWrapperController extends Controller
{
  public function show() 
  {
  	$soapURL = 'http://applicatifs.expert-infos.com/applicatifs.wsdl';
  	$soapClient = new SoapClient($soapURL);
  	$credentials = new stdClass();
  	$credentials->username = 'usw';
  	$credentials->password = 'FDbXp12';
  	$header = new SoapVar($credentials, SOAP_ENC_OBJECT);
  	$head = new SoapHeader('AuthHeader', 'AuthHeader', $header, false);
  	$soapClient->__setSoapHeaders([$head]);
  	dd($soapClient->__soapCall('calculACSv2', [1, 4, 20, 5]));
  }
  public function php() 
  {
    return phpinfo();
  }
}