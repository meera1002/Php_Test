<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\SubscriberInterface;
use App\Traits\ApiResponser;
use Mail;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    use ApiResponser;
    public function __construct( SubscriberInterface $sbc ) {
        $this->sbc = $sbc;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->sbc->getSubscribers();
        return view( 'welcome', compact( 'users' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( !$request->input('fullName') ){
            return $this->errorResponse( 'error', Response::HTTP_BAD_REQUEST );
        }
        if( !$request->input('email') ){
            return $this->errorResponse( 'error', Response::HTTP_BAD_REQUEST );
        }
        $id = $this->sbc->store($request->input());
        if( $id ){
            return $this->successResponse( 'success', Response::HTTP_OK );
        }

    }


    /**
     * sendEmail the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function sendEmail(Request $request)
    {
        $arr = array();
        if( $request->input('checkv') && $request->input('message') && $request->input('subject') ) {
            $subscribers = $this->sbc->getSubscribersById($request->input('checkv'));
            if( !empty( $subscribers ) ){
                foreach( $subscribers as $row ){
                    Mail::send( 'mail.email_notification', array(
                        'note' => $request->input('message'),
                        'name' => $row->name
                    ), function( $message ) use ($row,$request) {
                        $message->to( $row->email, $row->name )->subject( $request->input('subject') );
                    } );
                }

                $arr['success'] = 1;
                return response()->json($arr);
                exit();
            }

        }
        $arr['error'] = 1;
        $arr['errormsg'] = "Missing details";
        return response()->json($arr);
        exit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if( $id ) {
            $this->sbc->destroy($id);
        }
        return redirect('/');
    }
}
