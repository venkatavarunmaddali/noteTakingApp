<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NotesController extends Controller
{

	public function index(Request $request){
		$notes = Note::get();
		$response = [
			"status" => "success",
			"data" => $notes
		];
		return response()->json($response,200);
	}

	public function getById(Request $request){
		$note = Note::where('id',$request->id)->first();
		if($note){
			$response = [
				"status" => "success",
				"data" => $note
			];
			return response()->json($response,200);
		}else {
			$response = [
				"status" => "fail",
				"message" => "no note available with the given Id Please check the id number and try again"
			];
			return response()->json($response,400);
		}
	}

	public function create(Request $request){
		$note_data = [
			'note' => $request->note
		];
		return Note::create($note_data);

	}

	public function update(Request $request, $id){
		$existing_note = Note::find($id);
		if($existing_note){
			$existing_note->note = $request->note;
			$existing_note->save();
			$response = [
				"status" => "success",
				"data" => $existing_note
			];
			return response()->json($response,200);
		}else {
			$response = [
				"status" => "fail",
				"message" => "no note available with the given Id Please check the id number and try again"
			];
			return response()->json($response,400);
		}
	}

	public function delete($id){
		$existing_note = Note::find($id);
		if($existing_note){
			$existing_note->delete();
			$response = [
				"status" => "success",
				"data" => "deleted successfully"
			];
			return response()->json($response,200);
		}else {
			$response = [
				"status" => "fail",
				"message" => "no note available with the given Id Please check the id number and try again"
			];
			return response()->json($response,400);
		}
	}

}
