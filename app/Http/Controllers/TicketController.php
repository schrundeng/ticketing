<?php

namespace App\Http\Controllers;

use App\Models\TicketModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class TicketController extends Controller
{
    public function getTicket()
    {
        $ticket = TicketModel::get();
        $response = [
            'status' => true,
            'data' => $ticket,
            'message' => 'Success'
        ];

        return Response::json($response);
    }

    public function getTicketId($id_ticket)
    {
        $ticket = TicketModel::where('id_ticket', $id_ticket)->get();
        $response = [
            'status' => true,
            'data' => $ticket,
            'message' => 'Success'
        ];

        return Response::json($response);
    }

    public function addTicket(request $req)
    {
        $validator = validator::make($req->all(), [
            'id_user' => 'required', //(harusnya fetch dari login user)
            'id_pengelola' => 'required', //(harusnya fetch dari login pengelola)
            'description' => 'required',
            'id_category' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save = TicketModel::create([
            'id_user' => $req->get('id_user'), //(harusnya fetch dari login user)
            'id_pengelola' => $req->get('id_pengelola'), //(harusnya fetch dari login operator)
            'description' => $req->get('description'),
            'id_category' => $req->get('id_category'),
            'status' => 0
        ]);
        if ($save) {
            return response()->json(['status' => true, 'message' => 'Successfully made new ticket']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to make ticket']);
        }
    }

    public function updateTicket(Request $req, $id_ticket)
    {
        $validator = validator::make($req->all(), [
            'id_user' => 'required', //(harusnya fetch dari login user)
            'id_pengelola' => 'required', //(harusnya fetch dari login pengelola)
            'description' => 'required',
            'id_category' => 'required',
            'status' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $ticket = TicketModel::find($id_ticket);

        if (!$ticket) {
            return response()->json(['status' => false, 'message' => 'Ticket not found']);
        }
        $ticket = TicketModel::where('id_ticket', $id_ticket)->update([
            'id_user' => $req->get('id_user'), //(harusnya fetch dari login user)
            'id_pengelola' => $req->get('id_pengelola'), //(harusnya fetch dari login pengelola)
            'description' => $req->get('description'),
            'id_category' => $req->get('id_category'),
            'status' => $req->get('status'),
        ]);
        if ($ticket) {
            return response()->json(['status' => true, 'message' => 'Successfully updated ticket']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to update ticket']);
        }
    }

    public function deleteTicket($id_ticket)
    {
        $delete = TicketModel::where('id_ticket', $id_ticket)->delete();
        if ($delete) {
            return response()->json(['status' => true, 'massage' => 'Ticket deleted']);
        } else {
            return response()->json(['status' => false, 'massage' => 'Failed to delete ticket']);
        }
    }
}
