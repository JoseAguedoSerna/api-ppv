<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;

class TicketsController extends Controller
{
    // obtiene todos los registros
    public function index(Request $request)
    {
        // $tickets = Tickets::paginate(10);
        $tickets = DB::table('Tickets')        
        ->select(['Tickets.*',DB::raw("CONCAT(Empleados.Nombre,' ',Empleados.ApellidoPaterno,' ',Empleados.ApellidoMaterno)  AS Nombre"),'TiposTickets.Nombre as TipoTicket','CategoriasTickets.Nombre as CategoriaTicket','PrioridadTickets.Nombre as PrioridadTicket','StatusTickets.Nombre as StatusTicket'])
        ->join('Empleados', 'Tickets.Asignadoa', '=', 'Empleados.uuid')
        ->join('TiposTickets', 'Tickets.uuidTipoTicket', '=', 'TiposTickets.uuid')
        ->join('CategoriasTickets', 'Tickets.uuidCategoriaTicket', '=', 'CategoriasTickets.uuid')
        ->join('PrioridadTickets', 'Tickets.uuidPrioridadTickets', '=', 'PrioridadTickets.uuid')
        ->join('StatusTickets', 'Tickets.uuidStatusTicket', '=', 'StatusTickets.uuid')    
        ->whereNull('Tickets.deleted_at')
        ->get();
        //$tickets = DB::table('Tickets')
        //->select(['Tickets.*',DB::raw("CONCAT(Empleados.Nombre,' ',Empleados.ApellidoPaterno,' ',Empleados.ApellidoMaterno)  AS Nombre"),'TiposTickets.Nombre as TipoTicket','CategoriasTickets.Nombre as CategoriaTicket','PrioridadTickets.Nombre as PrioridadTicket','StatusTickets.Nombre as StatusTicket'])
        //->join('TiposTickets', 'Tickets.uuidTipoTicket', '=', 'TiposTickets.uuid')
        //->join('CategoriasTickets', 'Tickets.uuidCategoriaTicket', '=', 'CategoriasTickets.uuid')
        //->join('PrioridadTickets', 'Tickets.uuidPrioridadTickets', '=', 'PrioridadTickets.uuid')
       // ->join('StatusTickets', 'Tickets.uuidStatusTicket', '=', 'StatusTickets.uuid')
       // ->whereNull('Tickets.deleted_at')
       // ->get();

        $tickets = Tickets::with('empleado', 'tipoTicket', 'categoriaTicket', 'prioridadTicket', 'statusTicket')
            ->selectRaw('Tickets.*, CONCAT(Empleados.Nombre, " ", Empleados.ApellidoPaterno, " ", Empleados.ApellidoMaterno) AS Nombre')
            ->whereNull('Tickets.deleted_at')
            ->get();


        // $tickets::paginate(10);

    
        // $tickets::paginate(10);
        // return response()->json([
        //     'data' => $tickets->toArray(),
        //     'current_page' => $tickets->currentPage(),
        //     'last_page' => $tickets->lastPage(),
        //     'total' => $tickets->total()
        // ]);
        return $tickets;
    }
    public function show(Request $request)
    {
        $tickets = Tickets::where('Cve',$request->cve)->get();
        return json_encode($tickets);
    }
    // insert
    public function store(Request $request)
    {
        $nuevo_tickets = new Tickets();
        try {
            $nuevo_tickets::create([
                'Cve'=> $request->cve,
                'Descripcion'=> $request->descripcion,
                'Asignadoa'=> $request->asignadoa,
                'uuidTipoTicket'=> $request->uuidtipoticket,
                'uuidCategoriaTicket'=> $request->uuidcategoriaticket,
                'uuidPrioridadTickets'=> $request->uuidprioridadticket,
                'uuidStatusTicket'=> $request->uuidstatusticket,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
        } catch (Throwable $e) {
            abort(403, $e->getMessage());
        }
        $firstTickets = Tickets::latest('uuid', 'asc')->first();
        $data = json_encode($firstTickets);
        return $data;
    }
    // update registro
    public function update(Request $request)
    {
        $tickets = Tickets::find($request->uuid);
        try {
            $tickets->update([
                'Cve' => $request->cve,
                'Nombre' => $request->nombre,
                'Descripcion' => $request->descripcion,
                'Asignadoa'=> $request->asignadoa,
                'CreadoPor' => $request->creadopor,
                'ModificadoPor' => $request->modificadopor,
                'EliminadoPor' => $request->eliminadopor
                ]);
                $tickets->uuid;
        } catch (Throwable $e) {
            abort(404, $e->getMessage());
        }
        $data = json_encode($tickets);
        return $data;
    }
    // Delete
    public function destroy(Request $request)
    {
        $tickets = Tickets::find($request->uuid);
        $tickets->Delete();
        return $tickets;
    }
}
