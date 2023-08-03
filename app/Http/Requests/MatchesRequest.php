<?php

namespace App\Http\Requests;

use App\Enums\GameEnum;
use Illuminate\Foundation\Http\FormRequest;

class MatchesRequest extends FormRequest
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
            'game_id' => ['int', 'nullable'],
            'event_id' => ['int', 'nullable'],
            'team_id' => ['int', 'nullable'],
            'event_eng' => ['string', 'nullable'],
            'team_eng' => ['string', 'nullable'],
        ];
    }

    public function validationData(): array
    {
        return [
            'game_id' => $this->get('game_id', GameEnum::tryFromEng($this->get('game_eng', ''))?->value),
            'event_id' => $this->get('event_id'),
            'event_eng' => $this->get('event_eng'),
            'team_id' => $this->get('team_id'),
            'team_eng' => $this->get('team_eng'),
        ];
    }
}
