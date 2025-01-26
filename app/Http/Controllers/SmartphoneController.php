<?php

namespace App\Http\Controllers;

use App\Models\Smartphone;
use Illuminate\Http\Request;

class SmartphoneController extends Controller
{
    // GET /api/smartphones
    public function index()
    {
        return response()->json(Smartphone::all(), 200);
    }

    // GET /api/smartphones/{id}
    public function show($id)
    {
        $phone = Smartphone::find($id);
        if (!$phone) {
            return response()->json(['error' => 'Smartphone no encontrado'], 404);
        }
        return response()->json($phone, 200);
    }

    // POST /api/smartphones
    public function store(Request $request)
    {
        // Validar que se envíen campos mínimos o aplica tus propias reglas
        // $this->validate($request, [...]);

        $phone = Smartphone::create([
            'Brand' => $request->input('Brand'),
            'Model' => $request->input('Model'),
            'Ram' => $request->input('Ram'),
            'Rom' => $request->input('Rom'),
            'ScreenSize' => $request->input('ScreenSize'),
            'Battery' => $request->input('Battery'),
            'Price' => $request->input('Price'),
            'Color' => $request->input('Color'),
            'CameraPixels' => $request->input('CameraPixels'),
            'Network' => $request->input('Network'),
            'Availability' => $request->input('Availability'),
            'Img' => $request->input('Img')
        ]);

        return response()->json($phone, 201);
    }

    // PUT /api/smartphones/{id}
    public function update(Request $request, $id)
    {
        $phone = Smartphone::find($id);
        if (!$phone) {
            return response()->json(['error' => 'No encontrado'], 404);
        }

        $phone->update([
            'Brand' => $request->input('Brand', $phone->Brand),
            'Model' => $request->input('Model', $phone->Model),
            'Ram' => $request->input('Ram', $phone->Ram),
            'Rom' => $request->input('Rom', $phone->Rom),
            'ScreenSize' => $request->input('ScreenSize', $phone->ScreenSize),
            'Battery' => $request->input('Battery', $phone->Battery),
            'Price' => $request->input('Price', $phone->Price),
            'Color' => $request->input('Color', $phone->Color),
            'CameraPixels' => $request->input('CameraPixels', $phone->CameraPixels),
            'Network' => $request->input('Network', $phone->Network),
            'Availability' => $request->input('Availability', $phone->Availability),
            'Img' => $request->input('Img', $phone->Img),
        ]);

        return response()->json($phone, 200);
    }

    // DELETE /api/smartphones/{id}
    public function destroy($id)
    {
        $phone = Smartphone::find($id);
        if (!$phone) {
            return response()->json(['error' => 'No encontrado'], 404);
        }
        $phone->delete();
        return response()->json(['message' => 'Smartphone eliminado'], 200);
    }
}
