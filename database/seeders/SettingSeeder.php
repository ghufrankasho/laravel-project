<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key'=>'ar_site_name',
                'value_actual'=> serialize('اسم الموقع بالعربي') ,
                'value_default'=> serialize('اسم الموقع بالعربي'),
                'title'=> 'Site name in Arabic',
                'type'=>'string'
            ] ,
            [
                'key'=>'en_site_name',
                'value_actual'=> serialize('Site name'),
                'value_default'=> serialize('Site name'),
                'title'=> 'Site name in English',
                'type'=>'string'
            ] ,
            [
                'key'=>'tr_site_name',
                'value_actual'=> serialize('Site name'),
                'value_default'=> serialize('Site name'),
                'title'=> 'Site name in Turkish',
                'type'=>'string'
            ] ,
            [
                'key'=>'ar_site_description',
                'value_actual'=> serialize('وصف الموقع بالعربي') ,
                'value_default'=> serialize('وصف الموقع بالعربي'),
                'title'=> 'Site description in Arabic',
                'type'=>'string'
            ] ,
            [
                'key'=>'en_site_description',
                'value_actual'=> serialize('Site description'),
                'value_default'=> serialize('Site description'),
                'title'=> 'Site description in English',
                'type'=>'string'
            ] ,
            [
                'key'=>'tr_site_description',
                'value_actual'=> serialize('Site description'),
                'value_default'=> serialize('Site description'),
                'title'=> 'Site description in Turkish',
                'type'=>'string'
            ] ,
            [
                'key'=>'ar_site_keywords',
                'value_actual'=> serialize('كلمات مفتاحية') ,
                'value_default'=> serialize('كلمات مفتاحية'),
                'title'=> 'Site keywords in Arabic',
                'type'=>'string'
            ] ,
            [
                'key'=>'en_site_keywords',
                'value_actual'=> serialize('en_site_keywords') ,
                'value_default'=> serialize('en_site_keywords'),
                'title'=> 'Site keywords in English',
                'type'=>'string'
            ] ,
            [
                'key'=>'tr_site_keywords',
                'value_actual'=> serialize('Site keywords'),
                'value_default'=> serialize('Site keywords'),
                'title'=> 'Site keywords in Turkish',
                'type'=>'string'
            ] ,
            [
                'key'=>'default_language',
                'value_actual'=> serialize('en'),
                'value_default'=> serialize('en'),
                'title'=> 'set default language as: en for English, ar For Arabic and tr for Turkish',
                'type'=>'string'
            ] ,
            [
                'key'=>'facebook',
                'value_actual'=> serialize('https://facebook.com'),
                'value_default'=> serialize('https://facebook.com'),
                'title'=> 'facebook url',
                'type'=>'string'
            ] ,
            [
                'key'=>'twitter',
                'value_actual'=> serialize('https://twitter.com'),
                'value_default'=> serialize('https://twitter.com'),
                'title'=> 'twitter url',
                'type'=>'string'
            ] ,
            [
                'key'=>'instagram',
                'value_actual'=> serialize('https://Instagram.com'),
                'value_default'=> serialize('https://Instagram.com'),
                'title'=> 'Instagram url',
                'type'=>'string'
            ] ,
            [
                'key'=>'behance',
                'value_actual'=> serialize('https://behance.com'),
                'value_default'=> serialize('https://behance.com'),
                'title'=> 'behance url',
                'type'=>'string'
            ] ,
            [
                'key'=>'linkedin',
                'value_actual'=> serialize('https://linkedin.com'),
                'value_default'=> serialize('https://linkedin.com'),
                'title'=> 'linkedin url',
                'type'=>'string'
            ] ,
            [
                'key'=>'pinterest',
                'value_actual'=> serialize('https://pinterest.com'),
                'value_default'=> serialize('https://pinterest.com'),
                'title'=> 'pinterest url',
                'type'=>'string'
            ] ,
        ]);

    }
}
