<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notifications;
use App\Models\Product;

class NotificationController extends Controller
{
    // view noifications page
    public function notifications() {
        $nots = Notifications::all();
        return view('admin.notifications', compact('nots'));
    }  
    // view all nots
    public function all_nots() {
        $nots = Notifications::all();
        return view('admin.layouts.notifications', compact('nots'));
    } 
    // delete note
    public function delete_note() {
        $note_id = $_GET['record_id'];
        Notifications::findOrFail($note_id)->delete();
        return response()->json(['success' => $note_id]);
    } 
    // update note
    public function update_note() {
        $pro_id = $_GET['pro_id'];
        $note_id = $_GET['note_id'];
        $new_stock = $_GET['new_stock'];
        Product::whereId($pro_id)->update(['stock'=>$new_stock]);
        Notifications::whereId($note_id)->update(['qty'=>$new_stock]);
        return response()->json(['success' => $new_stock]);
    } 

}
