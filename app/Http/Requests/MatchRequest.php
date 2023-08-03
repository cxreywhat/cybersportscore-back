<?php

namespace App\Http\Requests;

use GamesType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use MatchBroadcastType;

class MatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
//            'live' => [new Enum(MatchBroadcastType::class)],
//            'game_id' => [new Enum(GamesType::class)],
        ];
    }
}
