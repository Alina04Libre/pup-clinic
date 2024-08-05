<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    //

    public function save(Request $request)
    {
        try {
            $title = $request->input('title');
            $jsonData = json_decode($request->input('maintenanceData'), true);

            if (!empty($title) && is_array($jsonData)) {
                $maintenance = Maintenance::where('title', $title)->first();

                if ($maintenance) {
                    // Title already exists, update the list
                    $existingList = json_decode($maintenance->list, true);
                    $newList = array_merge($existingList, $jsonData);
                    $maintenance->update([
                        'list' => json_encode($newList),
                    ]);
                } else {
                    // Title doesn't exist, create a new entry
                    Maintenance::create([
                        'title' => $title,
                        'list' => json_encode($jsonData),
                    ]);
                }
            } else {
                return response()->json(['error' => 'No data or title provided for saving.'], 400);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred while saving maintenance data.'], 500);
        }
    }




    public function newMaintenance()
    {

        return view('admin.new_maintenance');
    }

    public function editMaintenance($id)
    {
        // Fetch the maintenance record based on the $id
        $maintenance = Maintenance::find($id);

        if (!$maintenance) {
            Alert::info('info', 'No existing record!');
            return redirect();
        }

        // Assuming your 'list' field is stored as JSON, you can decode it
        $existingData = json_decode($maintenance->list, true);

        // Pass the existing data to the view
        return view('admin.edit_maintenance', [
            'maintenanceId' => $id,
            'existingTitle' => $maintenance->title,
            'existingData' => $existingData,
        ]);
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         // Find the maintenance record by ID
    //         $maintenance = Maintenance::find($id);

    //         if (!$maintenance) {
    //             return response()->json(['error' => 'Maintenance record not found.'], 404);
    //         }

    //         $title = $request->input('title');
    //         $keys = $request->input('keys');
    //         $lists = $request->input('lists');

    //         $data = [];

    //         if (!empty($title) && is_array($keys) && is_array($lists)) {
    //             // Process the submitted keys and lists
    //             for ($i = 0; $i < count($keys); $i++) {
    //                 $key = $keys[$i];
    //                 $list = $lists[$i];

    //                 if (!empty($key) || !empty($list)) {
    //                     // Update or add the entry
    //                     $data[$key] = $list;
    //                 }
    //             }

    //             Log::info('Title: ' . $title);
    //             Log::info('Keys: ' . json_encode($keys));
    //             Log::info('Lists: ' . json_encode($lists));
    //             // Update the title and list data
    //             $maintenance->title = $title;
    //             $maintenance->list = json_encode($data);
    //             $maintenance->save();

    //             Alert::success('Success', 'Data Updated Successfully');
    //             return redirect()->route('viewMaintenance');
    //         } else {
    //             Alert::error('Error', 'Invalid title or data provided for updating.');
    //         }
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         Alert::error('Error', 'An error occurred while updating maintenance data.');
    //         return response()->json(['error' => 'An error occurred while updating maintenance data.'], 500);
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //     // dd($request->all());
    //     try {
    //         $title = $request->input('title');
    //         $jsonData = $request->input('maintenanceData');

    //         // Check if $jsonData is not empty and is a valid JSON string
    //         if (!empty($title) && is_array(json_decode($jsonData, true))) {
    //             $jsonData = json_decode($jsonData, true);

    //             // Find the maintenance record by title
    //             $maintenance = Maintenance::where('title', $title)->first();

    //             if ($maintenance) {
    //                 // Title already exists, update the list
    //                 $existingList = json_decode($maintenance->list, true);
    //                 $newList = array_merge($existingList, $jsonData);

    //                 $maintenance->update([
    //                     'list' => json_encode($newList),
    //                 ]);
    //             } else {
    //                 // Title doesn't exist, create a new entry
    //                 Maintenance::create([
    //                     'title' => $title,
    //                     'list' => json_encode($jsonData),
    //                 ]);
    //             }

    //             // Return a success response
    //             return response()->json(['message' => 'Maintenance data saved successfully'], 200);
    //         } else {
    //             return response()->json(['error' => 'Invalid data or title provided for saving.'], 400);
    //         }
    //     } catch (\Exception $e) {
    //         // Log the error
    //         Log::error($e->getMessage());

    //         // Return an error response
    //         return response()->json(['error' => 'An error occurred while saving maintenance data.'], 500);
    //     }
    // }
    public function update(Request $request, $maintenanceId)
    {
        try {
            // Validate the request data, if needed.
        
            // Decode the JSON data from the request.
            $decodedData = json_decode($request->input('maintenanceData'), true);
        
            // Find the maintenance record by ID.
            $maintenance = Maintenance::findOrFail($maintenanceId);
        
            // Update the attributes of the maintenance record.
            $maintenance->title = $request->input('title');
            $maintenance->list = $decodedData; // Update the "list" column
        
            // Save the updated maintenance record.
            $maintenance->save();
        
            // Log a successful update
            Log::info('Maintenance record updated successfully.');
        
            // Handle the response, e.g., redirect or return a JSON response.
        } catch (\Exception $e) {
            // Log any exceptions that occur during the update
            Log::error('Error while updating maintenance: ' . $e->getMessage());
        
            // Handle the exception, e.g., return an error response.
        }
        
        
        
    }
}
