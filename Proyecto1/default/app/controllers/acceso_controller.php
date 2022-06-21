<?php

class AccesoController extends AppController
{
    public function index()
    {
        View::template(null);
    }

    public function listar($page = 1)
    {
        View::template(null);
         $this->listAcceso = (new Acceso())->getAcceso($page);
    }

    public function crear()
    {
        
        View::template(null);
        if (Input::hasPost('acceso')) {
            
            $abogado = new Acceso(Input::post('acceso'));
            //En caso que falle la operación de guardar
            if ($abogado->create()) {
                Flash::valid('Operación exitosa');
                //Eliminamos el POST, si no queremos que se vean en el form
                Input::delete();
                return;
            }
 
            Flash::error('Falló Operación');
        }
    }

  

    public function editar($id){
       
        View::template(null);
        $buscado = (new Acceso())->find_by_id((int)$id);

        if($buscado != NULL){
            $abogado = new Acceso();
            //verificar si se ha enviado el formulario
            if(Input::hasPost('acceso')){
                if($abogado->update(Input::post('acceso'))){
                    Flash::valid('Operacion exitosa');
                    return Redirect::to('acceso/listar');
                }
                Flash::error('Fallo la operación');
            return;
            }   
            $this->acceso = $abogado->find_by_id((int)$id);
        }else{
            Flash::error('El ID no existe');
            View::template('noID');
        }
        
    }

    public function eliminar($id){
        View::template(null);
        if((new Acceso())->delete((int) $id)){
            Flash::valid('Operacion Exitosa');
        }else{
            Flash::error('Fallo Operacion');

        }
        return Redirect::to('acceso/listar');
    }

    public function ver($id){
        View::template(null);
        $this->buscado = (new Acceso())->find_by_id((int)$id);
    }
}

