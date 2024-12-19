<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;

use App\Models\PlaceGaleryImage;

class PlaceGaleryImageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $placeGaleryImage = PlaceGaleryImage::findOrFail($id);

        if (empty($placeGaleryImage)) {
            Flash::error('Imagen de la galería no encontrada.');

            return redirect(route('lugar.edit', $placeGaleryImage->place_id));
        }

        $this->deleteFileImage($placeGaleryImage);

        $placeGaleryImage->delete($id);

        Flash::success('Imagen de la galería eliminada con éxito.');

        return redirect(route('lugar.edit', $placeGaleryImage->place_id));
    }

    public function deleteFileImage($placeGaleryImage)
    {
        if (\File::exists(public_path() . '/storage/place_galery/' . $placeGaleryImage->image)) {
            \File::delete(public_path() . '/storage/place_galery/' . $placeGaleryImage->image);
        } else {
            \Alert::message('¡La imagen de la galería no existe!', 'danger');
        }
    }
}
