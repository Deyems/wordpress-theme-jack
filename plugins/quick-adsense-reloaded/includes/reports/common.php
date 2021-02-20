<?php
if( !defined( 'ABSPATH' ) )
    exit;
add_action( 'admin_enqueue_scripts', 'quads_load_adsnese_scripts', 100 );
define('client_id','92665529714-hv86d98s4g3kkg62n4pej8foao38l2ri.apps.googleusercontent.com');
define('client_secret','Mh5lqjIt3ZmFX6ll2XnoK_tC');



add_action( 'rest_api_init', 'quads_registerRoute');

function quads_registerRoute($hook){
    register_rest_route( 'quads-adsense', 'quads_confirm_code', array(
        'methods'    => 'POST',
        'callback'   => 'quads_confirm_code',
        'permission_callback' => function(){
            return current_user_can( 'manage_options' );
        }
    ));
    register_rest_route( 'quads-adsense', 'quads_adsense_get_details', array(
        'methods'    => 'POST',
        'callback'   => 'quads_adsense_get_details',
        'permission_callback' => function(){
            return current_user_can( 'manage_options' );
        }
    ));
    register_rest_route( 'quads-adsense', 'get_report_status', array(
        'methods'    => 'POST',
        'callback'   => 'quads_adsense_get_report_status',
        'permission_callback' => function(){
            return current_user_can( 'manage_options' );
        }
    ));
    register_rest_route( 'quads-adsense', 'get_report_adsense', array(
        'methods'    => 'POST',
        'callback'   => 'quads_adsense_get_report_data',
        'permission_callback' => function(){
            return current_user_can( 'manage_options' );
        }
    ));
    register_rest_route( 'quads-adsense', 'revoke_adsense_link', array(
        'methods'    => 'POST',
        'callback'   => 'quads_adsense_revoke_adsense_link',
        'permission_callback' => function(){
            return current_user_can( 'manage_options' );
        }
    ));
}
function quads_adsense_revoke_adsense_link($request_data){
    $parameters = $request_data->get_params();
    $options = quads_get_option_adsense();
    $account_id = $parameters['account_id'];
    $token = $options['accounts'][ $account_id ]['refresh_token'];

    $url  = 'https://accounts.google.com/o/oauth2/revoke?token=' . $token;
    $args = array(
        'timeout' => 5,
        'header'  => array( 'Content-type' => 'application/x-www-form-urlencoded' ),
    );

    $response = wp_remote_post( $url, $args );
    if ( is_wp_error( $response ) ) {
        echo json_encode( array( 'status' => false ) );
    } else {
        //  remove all the adsense stats
        delete_option("quads_adsense_api_data");
        header( 'Content-Type: application/json' );
        echo json_encode( array( 'status' => true ) );
    }
}
function quads_adsense_get_report_status($request_data){
    $parameters = $request_data->get_params();
    $reportlist =array();
    $quads_get_option_adsense =quads_get_option_adsense();
    $account_id ='';
    $status = false;
    if(isset($quads_get_option_adsense['accounts']) && !empty($quads_get_option_adsense['accounts'])){
        $account_id =implode(',',array_keys($quads_get_option_adsense['accounts']));
        $status = true;
    }
    $reportlist['adsense'] =  array("status"=>$status,"account_id" =>$account_id);

    return $reportlist;
}
function quads_confirm_code($request_data){

    $parameters = $request_data->get_params();
    $code = isset($parameters['report']['adsense_code']) ?urldecode( $parameters['report']['adsense_code'] ) :'';
    $cid  = client_id;
    $cs   = client_secret;
    $code_url     = 'https://www.googleapis.com/oauth2/v4/token';
    $redirect_uri = 'urn:ietf:wg:oauth:2.0:oob';
    $grant_type   = 'authorization_code';

    $args = array(
        'timeout' => 10,
        'body'    => array(
            'code'          => $code,
            'client_id'     => $cid,
            'client_secret' => $cs,
            'redirect_uri'  => $redirect_uri,
            'grant_type'    => $grant_type,
        ),
    );
    $response = wp_remote_post( $code_url, $args );

    if ( is_wp_error( $response ) ) {
        return json_encode(
            array(
                'status' => false,
                'msg'    => 'error while submitting code',
                'raw'    => $response->get_error_message(),
            )
        );
    } else {
        $token      = json_decode( $response['body'], true );

        if ( null !== $token && isset( $token['refresh_token'] ) ) {
            $expires          = time() + absint( $token['expires_in'] );
            $token['expires'] = $expires;
            header( 'Content-Type: application/json' );
            echo json_encode(
                array(
                    'status'     => true,
                    'token_data' => $token,
                )
            );

        } else {
            header( 'Content-Type: application/json' );
            echo json_encode(
                array(
                    'status'        => false,
                    'response_body' => $response['body'],
                )
            );
        }
    }

    die;
}
function quads_adsense_get_details($request_data){
    $parameters = $request_data->get_params();

    $url        = 'https://www.googleapis.com/adsense/v1.4/accounts';
    $token_data = wp_unslash( $parameters );
//
    if ( ! is_array( $token_data ) ) {

        header( 'Content-Type: application/json' );
        echo json_encode(
            array(
                'status'    => false,
                'error_msg' => esc_html__( 'No token provided. Token data needed to get account details.', 'quick-adsense-reloaded' ),
            )
        );
        die;

    }

    $headers = array( 'Authorization' => 'Bearer ' . $token_data['access_token'] );
    $response = wp_remote_get( $url, array( 'headers' => $headers ) );

    if ( is_wp_error( $response ) ) {

        header( 'Content-Type: application/json' );
        echo json_encode(
            array(
                'status'    => false,
                'error_msg' => $response->get_error_message(),
            )
        );

    } else {

        $accounts = json_decode( $response['body'], true );
        if ( isset( $accounts['items'] ) ) {
            $options = quads_get_option_adsense();
            $options['connect_error'] = array();
            update_option( 'quads_adsense_api_data', $options );

            $adsense_id = $accounts['items'][0]['id'];
            $name = $accounts['items'][0]['name'];

            quads_save_token_from_data( $token_data, $accounts['items'][0]);

            header( 'Content-Type: application/json' );
            echo json_encode(
                array(
                    'status'     => true,
                    'adsense_id' => $adsense_id,
                    'name' => $name,
                )
            );


        } else {
            if ( isset( $accounts['error'] ) ) {
                $msg = esc_html__( 'An error occurred while requesting account details.', 'advanced-ads' );
                if ( isset( $accounts['error']['message'] ) ) {
                    $msg = $accounts['error']['message'];
                }

                $options = get_option();
                $options['connect_error'] = array(
                    'message' => $msg,
                );

                if ( isset( $accounts['error']['errors'][0]['reason'] ) ) {
                    $options['connect_error']['reason'] = $accounts['error']['errors'][0]['reason'];
                }

                update_option( 'quads_adsense_api_data', $options );

                header( 'Content-Type: application/json' );
                echo json_encode(
                    array(
                        'status'    => false,
                        'error_msg' => $msg,
                        'raw'       => $accounts['error'],
                    )
                );

            }
        }

    }

    die;

}
function quads_get_option_adsense(){
    $default_options =array(
        'accounts'          => array(),
        'ad_codes'          => array(),
        'unsupported_units' => array(),
        'quota'             => array(
            'count' => 20,
            'ts'    => 0,
        ),
        'connect_error' => array(),
    );
    $options = get_option( 'quads_adsense_api_data', array() );
    if ( ! is_array( $options ) ) {
        $options = array();
    }
    return $options + $default_options;
}

function quads_save_token_from_data( $token, $details, $args = array() ) {
    $empty_account_data = array(
        'access_token'  => '',
        'refresh_token' => '',
        'expires'       => 0,
        'token_type'    => '',
        'ad_units'    => array(),
        'details'     => array(),
    );
    $options    = quads_get_option_adsense();
    $adsense_id = $details ['id'];

    if ( ! isset( $options['accounts'][ $adsense_id ] ) ) {
        $options['accounts'][ $adsense_id ] = $empty_account_data;
    }
    $options['accounts'][ $adsense_id ] = array(
        'access_token'  => $token['access_token'],
        'refresh_token' => $token['refresh_token'],
        'expires'       => $token['expires'],
        'token_type'    => $token['token_type'],
    );
    $options['accounts'][ $adsense_id ]['details'] = $details;
    update_option( 'quads_adsense_api_data', $options );
}

function has_token( $adsense_id = '' ) {
    if ( empty( $adsense_id ) ) {
        return false;
    }

    $has_token = false;
    $options   = get_option();
    if ( isset( $options['accounts'][ $adsense_id ] ) && ! empty( $options['accounts'][ $adsense_id ]['refresh_token'] ) ) {
        $has_token = true;
    }

    return $has_token;

}
function quads_adsense_get_report_data($request_data){

    $parameters = $request_data->get_params();
    $report_period = (isset($parameters['report_period'])&& !empty($parameters['report_period']))?$parameters['report_period'] :'';
    $report_type = (isset($parameters['report_type'])&& !empty($parameters['report_type']))?$parameters['report_type'] :'';
    $StartingDate = mktime();  // todays date as a timestamp
//exit(print_r($report_period));
    switch ($report_period){
        case 'last_15days':
            $startDate = strtotime(" -14 day");
            break;
        case 'last_30days':
            $startDate = strtotime(" -29 day");
            break;
        case 'last_6months':
            $startDate = strtotime("-6 month");
            break;
        case 'last_1year':

            $startDate = strtotime('-1 year');
            break;
        default:
            $startDate = strtotime(" -6 day");
            break;
    }

    $account_id = $parameters['account_id'];
    $startDate = date("Y-m-d", $startDate);//date('Y-m-d',$startDate);
    $endDate = (isset($parameters['endDate'])&& $parameters['endDate'])?$parameters['endDate'] :date('Y-m-d');
    $token_data    = quads_adsense_get_access_token($account_id);

    switch ($report_type){

        case earning_forcast:
            $report_type = 'EARNINGS';//EARNINGS total of device amount is same
            $url        = 'https://www.googleapis.com/adsense/v1.4/accounts/'.$account_id.'/reports?startDate='.$startDate.'&endDate='.$endDate.'&dimension=DATE&dimension=EARNINGS&metric=EARNINGS&useTimezoneReporting=true';

            break;
        case top_adunit:
            $report_type = 'IMPRESSIONS';
            break;
        case top_device_type:
            $report_type = 'PLATFORM_TYPE_CODE';
            $url        = 'https://www.googleapis.com/adsense/v1.4/accounts/'.$account_id.'/reports?startDate='.$startDate.'&endDate='.$endDate.'&dimension=DATE&dimension=PLATFORM_TYPE_CODE&metric=EARNINGS&useTimezoneReporting=true';

            break;
        case earning:
        default:
            $report_type = 'EARNINGS';
            $url        = 'https://www.googleapis.com/adsense/v1.4/accounts/'.$account_id.'/reports?startDate='.$startDate.'&endDate='.$endDate.'&dimension=DATE&dimension=EARNINGS&metric=EARNINGS&useTimezoneReporting=true';

            break;
    }

    $token_data = wp_unslash( $token_data);

    $headers = array( 'Authorization' => 'Bearer ' . $token_data );
    $response = wp_remote_get( $url, array( 'headers' => $headers ) );

    if ( is_wp_error( $response ) ) {

        header( 'Content-Type: application/json' );
        echo json_encode(
            array(
                'status'    => false,
                'error_msg' => $response->get_error_message(),
            )
        );

    } else {
        $adsense_data_response = json_decode( $response['body'], true );
        $adsense_data = array();
        $i = 0;

        return $adsense_data_response['rows'];

    }

    die;

}
function quads_adsense_get_access_token($account){
    $options = quads_get_option_adsense();
    if ( isset( $options['accounts'][ $account ] ) ) {

        if ( time() > $options['accounts'][ $account ]['expires'] ) {
            $new_tokens = quads_adsense_renew_access_token( $account );
            if ( $new_tokens['status'] ) {
                return $new_tokens['access_token'];
            } else {
                // return all error info [arr]
                return $new_tokens;
            }
        } else {
            return $options['accounts'][ $account ]['access_token'];
        }

    } else {
        // Account does not exists.
        if ( ! empty( $options['accounts'] ) ) {
            // There is another account connected.
            return array(
                'status' => false,
                'msg' => esc_html__( 'It seems that some changes have been made in the Quads Ads settings. Please refresh this page.', 'advanced-ads' ),
                'reload' => true,
            );
        } else {
            // No account at all.
            return array(
                'status' => false,
                'msg' => wp_kses( sprintf( __( 'Advanced Ads does not have access to your account (<code>%s</code>) anymore.', 'advanced-ads' ), $account ), array( 'code' => true ) ),
                'reload' => true,
            );
        }
    }
}
function quads_adsense_renew_access_token( $account ) {

    $options       = quads_get_option_adsense();
    $access_token  = $options['accounts'][ $account ]['access_token'];
    $refresh_token = $options['accounts'][ $account ]['refresh_token'];

    $url  = 'https://www.googleapis.com/oauth2/v4/token';
    $args = array(
        'body' => array(
            'refresh_token' => $refresh_token,
            'client_id'     => client_id,
            'client_secret' => client_secret,
            'grant_type'    => 'refresh_token',
        ),
    );

    $response = wp_remote_post( $url, $args );

    if ( is_wp_error( $response ) ) {
        return array(
            'status' => false,
            'msg'    => sprintf( esc_html__( 'error while renewing access token for "%s"', 'advanced-ads' ), $account ),
            'raw'    => $response->get_error_message(),
        );
    } else {
        $tokens = json_decode( $response['body'], true );
        //  checking for the $tokens is not enough. it can be empty.
        //  monitored this, when the access token is revoked from the outside
        //  this can happen, when the user connects from another domain.
        if ( null !== $tokens && isset($tokens['expires_in']) ) {
            $expires = time() + absint( $tokens['expires_in'] );

            $options['accounts'][ $account ]['access_token'] = $tokens['access_token'];
            $options['accounts'][ $account ]['expires']      = $expires;

            update_option( 'quads_adsense_api_data', $options );
            return array(
                'status'       => true,
                'access_token' => $tokens['access_token'],
            );
        } else {
            return array(
                'status' => false,
                'msg'    => sprintf( esc_html__( 'invalid response received while renewing access token for "%s"', 'advanced-ads' ),  $account ),
                'raw'    => $response['body'],
            );
        }
    }
}
function quads_load_adsnese_scripts($hook){
    if($hook!=='toplevel_page_quads-settings'){ return ; }

    $js_dir  = QUADS_PLUGIN_URL . 'assets/js/';
//    $css_dir = QUADS_PLUGIN_URL . 'assets/css/';

    // Use minified libraries if SCRIPT_DEBUG is turned off
    $suffix = ( quadsIsDebugMode() ) ? '' : '.min';
    wp_enqueue_script( 'quads-admin-adsense', $js_dir . 'connect-adsense' . $suffix . '.js', array('jquery'), QUADS_VERSION, false );

    $auth_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' .
        urlencode( 'https://www.googleapis.com/auth/adsense.readonly' ) .
        '&client_id=' . client_id .
        '&redirect_uri=' . urlencode( 'urn:ietf:wg:oauth:2.0:oob' ) .
        '&access_type=offline&include_granted_scopes=true&prompt=select_account&response_type=code';

    wp_localize_script( 'quads-admin-adsense', 'quads_adsense', array(
        'auth_url' => $auth_url
    ) );
// chart js
    wp_enqueue_script( 'quads_charts_js', $js_dir . 'Chart' . $suffix . '.js', array('jquery'), QUADS_VERSION, false );
//    wp_localize_script( 'quads-charts-js' ,'');
    wp_enqueue_script( 'quads_charts_js' );
}
