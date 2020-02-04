<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lead extends Model
{

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'lead_name','lead_phone','lead_mail'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i:s');
    }

    public function autoria()
    {
        return $this->hasOne('App\Autoria', 'lead_id', 'id');
    }

    public function getWithPaginate($paginate)
    {
        return $this->with('autoria')->paginate($paginate);
    }

    public function getLeadsToVue($paginate)
    {

        foreach ($leads = $this->getWithPaginate($paginate) as &$lead) {
            $lead->destroy_link = route('leads.destroy', ['lead' => $lead->id]);
        }

        return $leads;
    }
}
