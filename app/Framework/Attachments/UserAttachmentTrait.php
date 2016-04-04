<?php
/**
 * UserAttachmentTrait.php
 *
 * Creator:         chongyi
 * Create Datetime: 2016/4/4 17:48
 */

namespace Inspirer\Framework\Attachments;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait UserAttachmentTrait
{
    /**
     * @return BelongsToMany
     */
    public function attachments()
    {
        return $this->belongsToMany(Attachment::class);
    }
}