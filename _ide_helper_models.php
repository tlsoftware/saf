<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Product
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Management[] $managements
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereName($value)
 */
	class Product extends \Eloquent {}
}

namespace App{
/**
 * App\Management
 *
 * @property int $id
 * @property string $description
 * @property int $quantity
 * @property float $price
 * @property string $dispatch_date
 * @property string $dispatch_time
 * @property int $customer_id
 * @property int $product_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property-read \App\Customer $customer
 * @property-read \App\Product $product
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereDispatchDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereDispatchTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Management whereUserId($value)
 */
	class Management extends \Eloquent {}
}

namespace App{
/**
 * App\Detail
 *
 * @property int $id
 * @property string $name
 * @property int $status_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Customer[] $customers
 * @property-read \App\Status $status
 * @method static \Illuminate\Database\Query\Builder|\App\Detail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Detail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Detail whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Detail whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Detail whereUpdatedAt($value)
 */
	class Detail extends \Eloquent {}
}

namespace App{
/**
 * App\Bstype
 *
 * @property int $id
 * @property string $type
 * @property string $size
 * @property int $quantity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Customer[] $customers
 * @method static \Illuminate\Database\Query\Builder|\App\Bstype whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bstype whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bstype whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Bstype whereType($value)
 */
	class Bstype extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $admin
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Customer[] $customers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Management[] $managemets
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User search($name)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Status
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Detail[] $details
 * @method static \Illuminate\Database\Query\Builder|\App\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Status whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Status whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Status whereUpdatedAt($value)
 */
	class Status extends \Eloquent {}
}

namespace App{
/**
 * App\Customer
 *
 * @property int $id
 * @property string $rut
 * @property string $bs_name
 * @property string $name
 * @property string $phone1
 * @property string $phone2
 * @property string $phone3
 * @property string $contact_name
 * @property string $position
 * @property string $email1
 * @property string $email2
 * @property string $email3
 * @property string $web
 * @property string $last_mng
 * @property string $next_mng
 * @property int $status_detail_id
 * @property int $user_id
 * @property int $bstype_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Bstype $bstype
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Management[] $managements
 * @property-read \App\Detail $status_detail
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Customer search($name)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereBsName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereBstypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereContactName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereEmail1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereEmail2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereEmail3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereLastMng($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereNextMng($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePhone1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePhone2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePhone3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereRut($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereStatusDetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereWeb($value)
 */
	class Customer extends \Eloquent {}
}

