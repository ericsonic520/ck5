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

    'accepted' => ':attribute 必須被接受。',
    'accepted_if' => '當 :other 為 :value 時，必須接受 :attribute。',
    'active_url' => ':attribute 不是有效的 URL。',
    'after' => ':attribute 必須是 :date 之後的日期。',
    'after_or_equal' => ':attribute 必須是晚於或等於 :date 的日期。',
    'alpha' => ':attribute 只能包含字母。',
    'alpha_dash' => ':attribute 只能包含字母、數字、破折號和底線。',
    'alpha_num' => ':屬性只能包含字母和數字。',
    'array' => ':attribute 必須是一個陣列。',
    'before' => ':attribute 必須是 :date 之前的日期。',
    'before_or_equal' => ':attribute 必須是早於或等於 :date 的日期。',
    'between' => [
        'numeric' => ':attribute 必須介於 :min 和 :max 之間。',
        'file' => ':attribute 必須介於 :min 和 :max KB 之間。',
        'string' => ':attribute 必須位於 :min 和 :max 個字元之間。',
        'array' => ':attribute 的項數必須介於 :min 和 :max 之間。',
    ],
    'boolean' => ':attribute 欄位必須為 true 或 false。',
    'confirmed' => ':屬性確認不符。',
    'current_password' => '密碼不正確。',
    'date' => ':attribute 不是有效日期。',
    'date_equals' => ':attribute 必須是等於 :date 的日期。',
    'date_format' => '：屬性與格式：格式不符。',
    '拒絕' => ':屬性必須被拒絕。',
    'declined_if' => '當 :other 為 :value 時，必須拒絕 :attribute。',
    ' different' => ':attribute 和 :other 必須不同。',
    'digits' => ':屬性必須是 :digits 數字。',
    'digits_ Between' => ':屬性必須介於 :min 和 :max 數字之間。',
    'dimensions' => ':attribute 的圖像尺寸無效。',
    'distinct' => ':attribute 欄位有重複值。',
    'email' => ':屬性必須是有效的電子郵件地址。',
    'ends_with' => ':attribute 必須以下列之一結尾：:values。',
    'enum' => '所選的：屬性無效。',
    'exists' => '所選的：屬性無效。',
    'file' => ':attribute 必須是一個檔案。',
    'filled' => ':attribute 欄位必須有一個值。',
    'gt' => [
        'numeric' => ':attribute 必須大於 :value。',
        'file' => ':attribute 必須大於 :value 千位元組。',
        'string' => '1:attribute 必須大於 :value 個字元。',
        'array' => ':attribute 必須有多個 :value 項。',
    ],
    'gte' => [
        'numeric' => ':attribute 必須大於或等於:value。',
        'file' => ':attribute 必須大於或等於 :value KB。',
        'string' => ':attribute 必須大於或等於 :value 個字元。',
        'array' => ':attribute 必須具有 :value 項或更多。',
    ],
    'image' => ':attribute 必須是圖像。',
    'in' => '所選的 :attribute 無效。',
    'in_array' => ':attribute 欄位在 :other 中不存在。',
    'integer' => ':attribute 必須是整數。',
    'ip' => ':attribute 必須是有效的 IP 位址。',
    'ipv4' => ':attribute 必須是有效的 IPv4 位址。',
    'ipv6' => ':attribute 必須是有效的 IPv6 位址。',
    'json' => ':attribute 必須是有效的 JSON 字串。',
    'lt' => [
        'numeric' => ':attribute 必須小於 :value。',
        'file' => ':attribute 必須小於 :value 千位元組。',
        'string' => ':attribute 必須小於 :value 個字元。',
        'array' => ':attribute 必須少於 :value 項。',
    ],
    'LTE' => [
        'numeric' => ':attribute 必須小於或等於:value。',
        'file' => ':attribute 必須小於或等於 :value 千位元組。',
        'string' => ':attribute 必須小於或等於 :value 個字元。',
        'array' => ':attribute 不得超過 :value 項。',
    ],
    'mac_address' => ':屬性必須是有效的 MAC 位址。',
    'max' => [
        'numeric' => ':attribute 不得大於 :max。',
        'file' => ':attribute 不得大於:max kilobytes。',
        'string' => ':attribute 不得大於 :max 個字元。',
        'array' => ':attribute 不得超過 :max 項。',
    ],
    'mimes' => ':attribute 必須是類型為: :values 的檔案。',
    'mimetypes' => ':attribute 必須是類型為: :values 的檔案。',
    'min' => [
        'numeric' => ':attribute 必須至少為 :min.',
        'file' => ':attribute 必須至少為 :min KB。',
        'string' => ':attribute 必須至少有 :min 個字元。',
        'array' => ':attribute 必須至少有 :min 個項目。',
    ],
    'multiple_of' => ':attribute 必須是 :value 的倍數。',
    'not_in' => '選擇的',
    'not_regex' => ':attribute 格式無效。',
     'numeric' => ':屬性必須是數字。',
     'password' => '密碼不正確。',
     'present' => ':attribute 字段必須存在。',
     'prohibited' => ':attribute 欄位被禁止。',
     'prohibited_if' => '當 :other 為 :value 時禁止:attribute 欄位。',
     'prohibited_unless' => '禁止 :attribute 字段，除非 :other 位於 :values 中。',
     'prohibits' => ':attribute 欄位禁止 :other 出現。',
     'regex' => ':attribute 格式無效。',
     'required' => ':attribute 欄位是必要的。',
     'required_array_keys' => ':attribute 欄位必須包含下列項目：:values。',
     'required_if' => '當 :other 為 :value 時，:attribute 欄位為必填。',
     'required_unless' => ':attribute 欄位是必要的，除非 :other 位於 :values 中。',
     'required_with' => '當 :values 存在時，:attribute 欄位是必需的。',
     'required_with_all' => '當 :values 存在時，:attribute 欄位是必需的。',
     'required_without' => '當 :values 不存在時，:attribute 欄位是必需的。',
     'required_without_all' => '當 :values 都不存在時，:attribute 欄位是必需的。',
     'same' => ':attribute 和 :other 必須匹配。',
     'size' => [
         'numeric' => ':屬性必須是:size。',
         'file' => ':attribute 必須是 :size KB。',
         'string' => ':attribute 必須是 :size 個字元。',
         'array' => ':attribute 必須包含 :size 項。',
     ],
     'starts_with' => ':attribute 必須以下列之一開頭：:values。',
     'string' => ':attribute 必須是字串。',
     'timezone' => ':屬性必須是有效的時區。',
     'unique' => ':屬性已被佔用。',
     'uploaded' => ':屬性上傳失敗。',
     'url' => ':attribute 必須是有效的 URL。',
     'uuid' => ':attribute 必須是有效的 UUID。',

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
            'rule-name' => '自訂訊息',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

     'attributes' => [
        'post_title' => '新聞標題',
        'post_sort' => '新聞類別',
        'post_description' => '新聞說明',
        'sort_name' => '類別名稱',
        'sort_name_en' => '類別英文名稱',
        'breadcrumb_name' => '麵包屑名稱',
        'breadcrumb_name_en' => '麵包屑英文名稱',
        'breadcrumb_api' => '麵包屑API',
        'menu_api' => '選單API',
        'menu_name' => '選單名稱',
        'menu_caption' => '選單標題',
        'menu_description' => '選單說明',
     ],

];
