<?php

namespace App\Services;

use App\Variable;
use App\State;
use App\Rules;
use App\Controllers;
use App\ControlAction as CA;
use DB;
use Illuminate\Routing\Redirector;

class VariableServices extends Services
{

    public function add($variable, $states_name)
    {
        parent::save($variable);
        
        //$states_name = $request->input('states');
        $states = [];

        //varible -> nossas variaveis com o dominio dela(states).
        //1 variable pode ter 1 - n STATES

        //CRIACAO DE TODAS
        //img 1 paint
        foreach ($states_name as $state_name) {
            $state = new State();
            $state->name = $state_name;
            $state->variable_id = $variable->id;
            parent::save($state);
            array_push($states, $state);
        }

        //REGRa que diz o que acontece com o sistema caso uma variable assuma um valor x
        //Adicionar uma nova variavel em um controlador já existente.
        if ($variable->controller_id > 0) {
            foreach (CA::where('controller_id', $variable->controller_id)->get() as $control_action) {
                //Criação de uma nova regra
                foreach (Rules::distinct()->select('index')
                    ->where('controlaction_id', $control_action->id)->get() as $rules) {
                    $rule = new Rules();
                    $rule->index = $rules->index;
                    $rule->variable_id = $variable->id;
                    $rule->state_id = 0;
                    $rule->controlaction_id = $control_action->id;
                    parent::save($rule);
                }
            }
        } else {
            foreach (Controllers::where('project_id', 1)->get() as $controller) {
                foreach (CA::where('controller_id', $controller->id)->get() as $control_action) {
                    foreach (Rules::distinct()->select('index')
                        ->where('controlaction_id', $control_action->id)->get() as $rules) {
                        $rule = new Rules();
                        $rule->index = $rules->index;
                        $rule->variable_id = $variable->id;
                        $rule->state_id = 0;
                        $rule->controlaction_id = $control_action->id;
                        parent::save($rule);
                    }
                }
            }
        }

        return response()->json([
            'name' => $variable->name,
            'id' => $variable->id,
            'controller_id' => $variable->controller_id,
            'states' => $states
        ]);
    }

    public function delete($id)
    {
        Rules::where('variable_id', $id)->delete();
        $states = State::where('variable_id', $id)->get();
        foreach ($states as $state) {
            DB::select(DB::raw("UPDATE context_tables 
                SET context = REPLACE(context, ',".$state->id.",', ',') WHERE context like '%,".$state->id.",%'"));
            DB::select(DB::raw("UPDATE context_tables 
                SET context = REPLACE(context, ',".$state->id."', '') WHERE context like '%,".$state->id."'"));
            DB::select(DB::raw("UPDATE context_tables 
                SET context = REPLACE(context, '".$state->id.",', '') WHERE context like '".$state->id.",%'"));
            State::destroy($state->id);
        }
        $variableDeletado = Variable::destroy($id);
        if ($variableDeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public function edit($variable)
    {
        parent::save($variable);
        return $variable;
    }

    public function read($id)
    {
        $variable = Variable::find($id);
        if (is_null($variable)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $variable;
    }

    public function all()
    {
        return Variable::all();
    }
}
