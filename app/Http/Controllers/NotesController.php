<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/** Models **/
use App\Models\Note;

/** Notes controller that takes care of CRUD operations**/
class NotesController extends Controller
{
	/**
	 * Get Notes API
	 * 
	 * @param Illuminate\Http\Request $request
	 * 
	 * @return Illuminate\Http\Response
	 * */
	public function index(Request $request){
		$notes = Note::get();
		$response = [
			"status" => "success",
			"data" => $notes
		];
		return response()->json($response,200);
	}

	/**
	 * Get a Note by id API
	 * 
	 * @param Illuminate\Http\Request $request
	 * 
	 * @return Illuminate\Http\Response
	 * */
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

	/**
	 * Create a note API
	 * 
	 * @param Illuminate\Http\Request $request
	 * notes structure
	 * {
	 * 	note: "note"
	 * }
	 * 
	 * @return Illuminate\Http\Response
	 * */
	public function create(Request $request){
		$note_data = [
			'note' => $request->note
		];
		return Note::create($note_data);

	}

	/**
	 * update a note by id API
	 * 
	 * @param Illuminate\Http\Request $request, int $id
	 * 
	 * @return Illuminate\Http\Response
	 * */
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


	/**
	 * Delete a note by id API
	 * 
	 * @param int $id
	 * 
	 * @return Illuminate\Http\Response
	 * */
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
