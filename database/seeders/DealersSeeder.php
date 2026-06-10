<?php

namespace Database\Seeders;
use App\Models\City;
use Illuminate\Database\Seeder;
use App\Models\Dealer;

class DealersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Астрахань' => [
                [
                    'address' => 'ул. Рождественского, 5',
                    'latitude' => 46.316464,
                    'longitude' => 48.047848,
                    'name' => 'ООО Диккайа групп',
                    'contact' => 'Михаил Дмитриевич',
                    'phone' => '+7(988)171-11-44',
                    'mail' => 'kenner30rus@mail.ru',
                    'active' => 1
                ],
                [
                    'address' => 'Магнитогорская улица, 18',
                    'latitude' => 46.349588,
                    'longitude' => 48.057618,
                    'name' => 'ООО Трубопласт',
                    'contact' => 'Обухов Олег Николаевич',
                    'phone' => '+7(927)079-81-83',
                    'mail' => 'director-ast@mail.ru',
                    'site' => 'https://obuhovgroup.ru/afisha',
                    'active' => 1
                ]
            ],
            'Барнаул' => [
                [
                    'address' => 'Павловский тракт, 45',
                    'latitude' => 53.339942,
                    'longitude' => 83.726603,
                    'name' => 'ООО Апгрейд',
                    'contact' => 'Журавлева Юлия Николаевна; Калина Ольга',
                    'phone' => '+7(3852)56-78-95; +7(913)271-02-63',
                    'mail' => 'snab@upgrade22.com',
                    'site' => 'https://upgrade22.com/',
                    'active' => 1
                ],
            ],
            'Белгород' => [
                [
                    'address' => 'Магистральная ул., 55Б, стр. 1',
                    'latitude' => 50.570319,
                    'longitude' => 36.535508,
                    'name' => 'ООО Термомир',
                    'contact' => 'Будник Максим Александрович',
                    'phone' => '+7(4722)23-17-17 (доб. 111)',
                    'mail' => 'm.budnik@termo31.ru; a.ospischev@termo31.ru',
                    'site' => 'https://www.termomir31.ru/',
                    'active' => 1
                ]
            ],
            'Владивосток' => [
                [
                    'address' => 'ул. Ильичёва, 6',
                    'latitude' => 43.149027,
                    'longitude' => 131.912371,
                    'name' => 'ООО «ТД Аквадом»',
                    'contact' => 'Алешин Алексей',
                    'phone' => '+7(423)2-333-077 (доб. 1032)',
                    'mail' => 'aaleshin@aquadom.info; vkislova@aquadom.info',
                    'site' => 'https://aquadom.info/',
                    'active' => 1
                ]
            ],
            'Владикавказ' => [
                [
                    'address' => 'Весенняя ул., 34А',
                    'latitude' => 43.045684,
                    'longitude' => 44.625496,
                    'name' => 'ООО Квант',
                    'contact' => 'Айдаров Алан Витальевич',
                    'phone' => '+7(988)832-11-18',
                    'mail' => 'kvant.elektro@yandex.ru; aydarti@mail.ru',
                    'active' => 1
                ]
            ],
            'Грозный' => [
                [
                    'address' => 'ул. Маты Кишиевой, 94',
                    'latitude' => 43.321866,
                    'longitude' => 45.711297,
                    'name' => 'ООО Теплострой 77',
                    'contact' => 'Абдаев Арби Султанович',
                    'phone' => '+7(928)475-20-77 ',
                    'mail' => 'teplostroy095@mail.ru',
                    'active' => 1
                ]
            ],
            'Казань' => [
                [
                    'address' => '1-я Владимирская ул., 110Б',
                    'latitude' => 55.826595,
                    'longitude' => 49.199113,
                    'name' => 'ООО Теплоформат',
                    'contact' => 'Самигуллин Ленар Радикович',
                    'phone' => '+7(987)061-64-61',
                    'mail' => 'lenar@teploformatopt.ru',
                    'active' => 1
                ],
                [
                    'address' => 'проспект Альберта Камалеева, 34, Казань офис 1, этаж 1',
                    'latitude' => 55.783724,
                    'longitude' => 49.194654,
                    'name' => 'ООО Теплостудия',
                    'contact' => 'Самусик Артем Валерьевич',
                    'phone' => '+7(960)036-65-10',
                    'mail' => 'thermostudiokazan@gmail.com',
                    'active' => 1
                ]
            ],
            'Краснодар' => [
                [
                    'address' => 'Дальняя ул., 39',
                    'latitude' => 45.061641,
                    'longitude' => 38.966866,
                    'name' => 'ИП Кравцов Эдуард Сергеевич (Краснодар Каскад Юг)',
                    'contact' => 'Кравцов Эдуард Сергеевич',
                    'phone' => '+7(909)46-47-947; +7(861)248-01-06',
                    'mail' => 'kaskad-yug@bk.ru',
                    'active' => 1
                ]
            ],
            'Симферополь' => [
                [
                    'address' => 'ул. Данилова, 43К',
                    'latitude' => 44.927425,
                    'longitude' => 34.072131,
                    'name' => 'ООО Астер',
                    'contact' => 'Михайлевский Вячеслав',
                    'phone' => '+7(978)777-82-16',
                    'mail' => 'snab@aster-m.su',
                    'site' => 'https://aster24.ru/',
                    'active' => 1
                ]
            ],
            'Москва' => [
                [
                    'address' => 'Логистический центр Славянский Мир',
                    'latitude' => 55.623069,
                    'longitude' => 37.460449,
                    'name' => 'ООО Версус групп',
                    'contact' => 'Суслин Андрей Николаевич; Виталий Курышов',
                    'phone' => '+7(965)373-80-82',
                    'mail' => 'kuryshov@versusgroup.ru',
                    'site' => 'https://versusgroup.ru/',
                    'active' => 1
                ]
            ],
            'Чебоксары' => [
                [
                    'address' => 'ул. Константина Иванова, 91',
                    'latitude' => 56.147101,
                    'longitude' => 47.226246,
                    'name' => 'ООО Стройкапитал',
                    'contact' => 'Лобанов Вадим Викторович',
                    'phone' => '+7(8352)325-326; +7(8352)44-88-77',
                    'mail' => 'log133@boilerberg.ru',
                    'active' => 1
                ]
            ]
        ];

        foreach ($data as $city => $dealers) {
            $city = City::query()->create(['name' => $city]);
            foreach ($dealers as $dealer) {
                $dealer['city_id'] = $city->id;
                Dealer::query()->create($dealer);
            }
        }
    }
}
