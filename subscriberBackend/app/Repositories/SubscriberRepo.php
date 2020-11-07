<?php
namespace App\Repositories;

use App\Contracts\SubscriberInterface;
use App\Subscriber;


class SubscriberRepo implements SubscriberInterface
{
    public function getSubscribers( ) {
        return Subscriber::where( 'status', '1' )->paginate( 10 );
    }
    public function destroy( $id ) {
        Subscriber::where('id', $id)
            ->update(['status' => '0']);
    }
    public function getSubscribersById( $ids ) {
        return Subscriber::whereIn('id', $ids)->get( );
    }
    public function store( $input ){
        return Subscriber::insertGetId(
            ['name' => $input['fullName'], 'email' => $input['email']]
        );
    }

}