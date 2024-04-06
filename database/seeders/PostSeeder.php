<?php

namespace Database\Seeders;


use App\Models\Post\Post;
use App\Services\Blog\PostCategory\PostCategoryServices;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class PostSeeder extends Seeder
{
    private PostCategoryServices $postCategoryServices;

    public function __construct()
    {
        $this->postCategoryServices = App::make(PostCategoryServices::class);
    }

    /**
     * Seed the application's database.
     * @throws Exception
     */
    public function run(): void
    {
        for ($i = 1; $i < 11; $i++) {
            $ids = $this->postCategoryServices->get()->pluck('id')->toArray();
            $id = $ids[random_int(0, count($ids) - 1)];
            Post::create([
                'post_category_id' => $id,
                'title' => 'Длинный заголовок поста №' . $i,
                'title_short' => 'Заголовок поста №' . $i,
                'preview_description' => 'Разнообразный и богатый опыт новая модель организационной деятельности требуют от нас анализа новых предложений. Повседневная практика показывает, что начало повседневной работы по формированию позиции представляет собой интересный эксперимент проверки новых предложений.',
                'description' => 'Разнообразный и богатый опыт новая модель организационной деятельности требуют от нас анализа новых предложений. Повседневная практика показывает, что начало повседневной работы по формированию позиции представляет собой интересный эксперимент проверки новых предложений. Разнообразный и богатый опыт постоянный количественный рост и сфера нашей активности способствует подготовки и реализации дальнейших направлений развития. Идейные соображения высшего порядка, а также начало повседневной работы по формированию позиции позволяет выполнять важные задания по разработке позиций, занимаемых участниками в отношении поставленных задач. Разнообразный и богатый опыт укрепление и развитие структуры влечет за собой процесс внедрения и модернизации существенных финансовых и административных условий.',
            ]);
            echo 'Post: ' . $i . PHP_EOL;
        }
    }
}
