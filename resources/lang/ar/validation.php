<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */
    'user_id.exists' => 'غير مسموح لك .',
    'accepted' => 'يجب قبول :attribute.',
    'active_url' => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after' => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash' => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array' => 'يجب أن يكون :attribute ًمصفوفة.',
    'before' => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between' => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean' => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'date' => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format' => 'لا يتوافق :attribute مع الشكل :format.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values',
    'exists' => 'القيمة المحددة :attribute غير موجودة.',
    'file' => 'الـ :attribute يجب أن يكون ملفا.',
    'filled' => ':attribute إجباري.',
    'gt' => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image' => 'يجب أن يكون :attribute صورةً.',
    'in' => ':attribute غير موجود.',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون :attribute نصًا من نوع JSON.',
    'lt' => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'min' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'multiple_of' => ':attribute يجب أن يكون من مضاعفات :value',
    'not_in' => 'العنصر :attribute غير صحيح.',
    'not_regex' => 'صيغة :attribute غير صحيحة.',
    'numeric' => 'يجب على :attribute أن يكون رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب تقديم :attribute.',
    'regex' => 'صيغة :attribute .غير صحيحة.',
    'required' => ':attribute مطلوب.',
    'required_if' => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless' => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all' => ':attribute مطلوب إذا توفّر :values.',
    'required_without' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other.',
    'size' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.',
        'array' => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string' => 'يجب أن يكون :attribute نصًا.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique' => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل في تحميل الـ :attribute.',
    'url' => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid' => ':attribute يجب أن يكون بصيغة UUID سليمة.',
    'failed' => 'البيانات المدخلة غير صحيحة.',
    'unacceped_dates' => 'هذة المواعيد مشغوله لديك . من فضلك اختر موعد اخر',
    'not allowed' => 'غير مسموح لك .',
    'property_image' => 'تأكد من الصور المرفوعة',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
     */

    'attributes' => [
        'name' => 'الاسم',
        'name_ar' => 'الاسم عربي',
        'name_en' => 'الاسم انجليزي',
        'username' => 'اسم المُستخدم',
        'email' => 'البريد الالكتروني',
        'password' => 'كلمة المرور',
        'old_password' => 'كلمة المرور القديمة',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'address' => 'العنوان',
        'address_ar'=>'العنوان عربي',
        'address_en'=>'العنوان انجليزي',
        'phone' => 'رقم الجوال',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'النوع',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'title' => 'العنوان',
        'content' => 'المُحتوى',
        'description' => 'الوصف',
        'description_ar' => 'الوصف عربي',
        'description_en' => 'الوصف انجليزي',
        'excerpt' => 'المُلخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'مُتاح',
        'size' => 'الحجم',
        'code' => ' الكود',
        'image' => 'الصورة',
        'terms_ar'=>'الشروط والاحكام عربي',
        'terms_en'=>'الشروط والاحكام انجليزي',
        'policy_ar'=>'سياسة الخصوصية عربي',
        'policy_en'=>'سياسة الخصوصية انجليزي',
        'tax'=>'الضريبة',
        'type'=>'النوع',
        'user_id'=>'اسم المستخدم',
        'code'=>'الكود',
        'start_date'=>'تاريخ البدء',
        'end_date'=>'تاريخ الانتهاء',
        'price'=>'السعر',
        'status'=>'الحالة',
        'lat'=>'الموقع',
        'lng'=>'الموقع',
        'logo'=>'الشعار',
        'title'=>'العنوان',
        'message'=>'الرسالة',
        'domain'=>'النطاق',
        'facebook'=>'فيس بوك',
        'instagram'=>'انستجرام',
        'twitter'=>'توتير',
        'snapchat'=>'سناب شات',
        'aboutUs_ar'=>'عن الموقع عربي',
        'aboutUs_en'=>'عن الموقع انجليزي',
        'company_name'=>'اسم الشركة',
        'company_type_id'=>'نوع الشركة',
        'commercial_registration_no'=>'رقم السجل التجاري',
        'commercial_registration_image'=>'صورة السجل التجاري',
        'jop_type_id'=>'المسمي الوظيفه',
        'city_id'=>'المدينة',
        'condition_ar'=>'شرط الوظفيه عربي',
        'condition_en'=>'شرط الوظيفه انجليزي',
        'single'=>'فردية',
        'monthly'=>'شهرية',
        'title_ar'=>'العنوان عربي',
        'title_en'=>'العنوان انجليزي',
        'no_of_days_guard'=>'عدد ايام النشر',
        'no_of_days_company'=>'عدد ايام الاشتراك',
        'no_of_days'=>'عدد الايام',
        'no_of_cvs'=>'عدد السيرة الذاتية',
        'discount'=>'الخصم',
        'type'=>'النوع',
        'district_id'=>'الحي',
        'cities'=>'المدن',
        'identification_id'=>'صورة الهوية',
        'iban_no'=>'رقم الحساب',
        'experience'=>'الخبرة',
        'experience_type'=>'نوع الخبرة',
        'qualification'=>'الموهل الدراسي',
        'social_status'=>'الحالة الاجتماعية',
        'package_id'=>'رقم الباقة' ,
        'package_type'=>'نوع الباقة',
        'age_from'=>'الحد الادني للعمر',
        'age_to'=>'الحد الادني للعمر',
        'salary'=>'الراتب',
        'no_of_hours'=>'عدد الساعات',
        'last_date_to_accept'=>'اخر موعد للقبول',
        'users'=>'الموظفين',
        'users.*'=>'الموظف',
        'holidays'=>'الاجازات',
        'holidays.*'=>'الاجازة',
        'conversation_id'=>'رقم المحادثة',
        'number_of_guards'=>'العدد المطلوب',
        'reason_ar'=>'السبب عربي',
        'reason_en'=>'السبب انجليزي',
        'reason'=>'السبب',
        'nature_ar'=>'طبيعهة العمل عربي',
        'nature_en'=>'طبيعة العمل انجليزي',
        'nature'=>'طبيعة العمل',
        'other_cities'=>'المدن التي يمكن العمل بها',
        'english'=>'مستوي اللغة الانجليزية',
        'main_image'=>'الصورة الاساسية',
        'videos'=>'الفيدهوهات',
        'videos.*'=>'الفيديو',
        'contact_reason_id'=>'سبب التواصل',
        'file'=>'الملف',
        'work_nature_id'=>'طبيعة العمل',
        'work_nature_text'=>'طبيعة العمل الاخري',
        'holiday'=>'الاجازة',

    ],
];
