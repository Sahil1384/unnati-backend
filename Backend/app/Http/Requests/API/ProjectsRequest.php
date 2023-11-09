<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_name' => 'required',
            'project_title' => 'required',
            'description' => 'required',
            'no_of_days' => 'required',
            'budget_rate' => 'required',
            'purchase_order' => 'required',
            'comment' => 'required',
            'price_type' => 'required',
            'invoice_time' => 'required',
            'priority' => 'required',
            'message' => 'required',
            'start_date' => 'required|date|before:now',
            'end_date' => 'required|date|after:start_date'            
        ];
    }
}
