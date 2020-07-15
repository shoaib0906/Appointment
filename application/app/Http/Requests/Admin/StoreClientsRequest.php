<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email',
            'visitor_per_hour' => 'required',
            'lunch_finish_time' => 'required',
            'lunch_start_time' => 'required',
            'finish_time' => 'required',
            'start_time' => 'required',
        ];
    }
}
