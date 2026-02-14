<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GmeBusinessForm extends Model
{
    protected $guarded = [];

    protected $casts = [
        'countries_of_operation' => 'array',
        'founders' => 'array',
        'services_id' => 'array',
        'collaboration_types' => 'array',
        'finance_practices' => 'array',  
        'product_practices' => 'array',   
        'community_practices' => 'array',
        'info_accuracy' => 'boolean',
        'allow_publish' => 'boolean',
        'allow_contact' => 'boolean',
        // 'is_verified' => 'boolean',
    ];

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
    }


    public function businessPhotos()
    {
        return $this->hasMany(BusinessPhoto::class, 'gme_business_form_id');
    }

    public function category()
    {
        return $this->belongsTo(BusinessCategory::class, 'business_category_id');
    }

    /**
     * Get the services
     */
    // public function services()
    // {
    //     return $this->belongsToMany(Service::class, 'service_id');
    // }
    // $casts থেকে 'services_id' => 'array' remove করুন

    public function getServicesAttribute()
    {
        // Raw value নিন (এটা already array কারণ cast করা আছে)
        $serviceIds = $this->attributes['services_id'] ?? null;

        if (empty($serviceIds)) {
            return collect([]);
        }

        // যদি string হয় (database থেকে আসলে), তাহলে decode করুন
        if (is_string($serviceIds)) {
            $serviceIds = json_decode($serviceIds, true);
        }

        if (empty($serviceIds) || !is_array($serviceIds)) {
            return collect([]);
        }

        // Integer এ convert করুন
        $serviceIds = array_map('intval', array_filter($serviceIds));

        if (empty($serviceIds)) {
            return collect([]);
        }

        return \App\Models\Service::whereIn('id', $serviceIds)->get();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Scope for approved businesses
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for pending businesses
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for rejected businesses
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Get founders count
     */
    public function getFoundersCountAttribute()
    {
        return count($this->founders ?? []);
    }

    /**
     * Get first founder name
     */
    public function getFirstFounderNameAttribute()
    {
        $founders = $this->founders;
        return $founders[0]['name'] ?? 'N/A';
    }

    /**
     * Check if business is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if business is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if business is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
