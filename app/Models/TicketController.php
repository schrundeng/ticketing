<?php

namespace App\Http\Controllers;

use App\Models\TicketModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\TicketDetailModel;


class TicketController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:user_model');
    // }

    public function createTicket(Request $request)
    {

        $userId = auth()->user()->id_user;

        // Validation rules
        $validator = Validator::make($request->all(), [
            'id_category' => 'required|exists:category,id_category',
            'id_pengelola' => 'required|exists:pengelola,id_pengelola',
            'description' => 'required|string',
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Create the ticket
            $ticket = new TicketModel();
            $ticket->id_ticket = Str::uuid();
            $ticket->id_user = $userId; // Replace with the actual user ID. This is manual for now but change later
            $ticket->id_pengelola = $request->input('id_pengelola'); // Replace with the actual pengelola ID. This is manual for now but change later
            $ticket->id_category = $request->input('id_category'); // Replace with the actual category ID. This is manual for now but change later
            $ticket->description = $request->input('description'); // Replace with the actual description. This is manual
            $ticket->date_created = now();
            $ticket->status = 0; // Set initial status to pending (0)
            $ticket->status_note = 'Pending';
            $ticket->created_at = now();
            $ticket->updated_at = now();

            // Save the ticket
            $ticket->save();

            // Optionally, create an initial ticket detail record
            $ticketDetail = new TicketDetailModel();
            $ticketDetail->id_detail_ticket = Str::uuid();
            $ticketDetail->id_ticket = $ticket->id_ticket;
            $ticketDetail->id_pengelola = $ticket->id_pengelola;
            $ticketDetail->date_created = now();
            $ticketDetail->ticket_note = 'Ticket created and pending resolution';
            $ticketDetail->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket created successfully',
                'ticket' => $ticket,
            ], 201);

        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create ticket: ' . $e->getMessage(),
            ], 500);
        }
    }

    //Method used to soft delete
    public function deleteTicket($id){
        $ticket = TicketModel::where('id_ticket', $id);
        $ticket->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Ticket deleted successfully',
        ], 200);
    }
}