<?php

namespace App\Services\Blog;

use App\Models\BaseModel;
use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Repositories\Interfaces\IBaseRepository;
use App\Services\Gallery\GalleryServices;
use App\Services\Image\ImageServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property IBaseRepository $repo
 * @property BaseModel $model
 * @property GalleryServices $galleryServices
 * @property ImageServices $imageServices
 *
 */
trait EntitySaveServices
{
    /**
     * @param int $id
     * @return Post|PostCategory|Page|null
     */
    public function find(int $id): ?BaseModel
    {
        /** @var Post|PostCategory|Page $model */
        $model = $this->repo->find($id);

        return $model;
    }

    /**
     * @return Post[]|PostCategory[]|Page[]|Collection
     */
    public function get(): Collection
    {
        /** @var Post[]|PostCategory[]|Page[]|Collection $model */
        $model = $this->repo->get();

        return $model;
    }

    /**
     * @param array $request
     * @return LengthAwarePaginator|Post[]|PostCategory[]|Page[]
     */
    public function filter(array $request): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator|Post[]|PostCategory[]|Page[] $filter */
        $filter = $this->repo->filter($request);

        return $filter;
    }

    /**
     * @param array $attributes
     * @return Post|PostCategory|Page
     */
    public function create(array $attributes): BaseModel
    {
        /** @var Post|PostCategory|Page $model */
        $attributes = $this->prepareAttributes($attributes);
        $model = $this->repo->create($attributes);
        $ids = $this->galleryServices->uploadFromArray($attributes);
        $this->repo->syncGallery($model, $ids);

        return $model;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return Post|PostCategory|Page
     */
    public function update(int $id, array $attributes): BaseModel
    {
        /** @var Post|PostCategory|Page $model */
        $attributes['id'] = $id;
        $attributes = $this->prepareAttributes($attributes);
        $model = $this->repo->update($id, $attributes);
        $ids = $this->galleryServices->uploadFromArray($attributes);
        $this->repo->syncGallery($model, $ids);

        return $model;
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function prepareAttributes(array $attributes): array
    {
        $attributes['id'] = $attributes['id'] ?? null;
        if (empty($attributes['alias'])) {
            $attributes['alias'] = $this->generateAlias($attributes['title']);
        }
        $alias = $this->prepareAlias($attributes);
        $attributes['alias'] = $alias;
        $attributes['url'] = $this->generateUrl($attributes);
        $attributes['images_path'] = '/upload/' . $this->model::table() . '/' . $alias;
        if ($attributes['image'] ?? null) {
            $attributes['image'] = $this->imageServices->load($attributes['image'], $attributes['images_path']);
        }
        $attributes['resource'] = $this->model::table();

        return $attributes;
    }

    /**
     * @param array $attributes
     * @return string
     */
    protected function prepareAlias(array $attributes): string
    {
        $cnt = 1;
        $temp = $attributes['alias'];
        while ($this->repo->existAlias($temp, $attributes['id'])) {
            $temp = $attributes['alias'] . '-' . $cnt;
            $cnt++;
        }

        return $temp;
    }

    /**
     * @param string $url
     * @param int|null $id
     * @return string
     */
    protected function prepareUrl(string $url, ?int $id = null): string
    {
        /** @var Post|PostCategory|Page $this */
        $cnt = 1;
        $temp = $url;
        while ($this->existUrl($temp, $id)) {
            $temp = $url . '-' . $cnt;
            $cnt++;
        }

        return $temp;
    }

    /**
     * @param array $attributes
     * @return string
     */
    protected function generateUrl(array $attributes): string
    {
        $url = '/' . trim($attributes['alias'], '/');

        return $this->prepareUrl($url, $attributes['id']);
    }

    /**
     * @param string $temp
     * @param int|null $id
     * @return bool
     */
    abstract public function existUrl(string $temp, ?int $id): bool;

    /**
     * @param string $str
     * @param array $options
     * @return string
     */
    protected function generateAlias(string $str, array $options = []): string
    {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding($str, 'UTF-8', mb_list_encodings());

        $defaults =
            ['delimiter' => '-', 'limit' => null, 'lowercase' => true, 'replacements' => [], 'transliterate' => true,];

        // Merge options
        $options = array_merge($defaults, $options);

        $char_map = [// Latin
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'AE',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ð' => 'D',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ő' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ű' => 'U',
            'Ý' => 'Y',
            'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'ae',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'd',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ő' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ű' => 'u',
            'ý' => 'y',
            'þ' => 'th',
            'ÿ' => 'y',

            // Latin symbols
            '©' => '(c)',

            // Greek
            'Α' => 'A',
            'Β' => 'B',
            'Γ' => 'G',
            'Δ' => 'D',
            'Ε' => 'E',
            'Ζ' => 'Z',
            'Η' => 'H',
            'Θ' => '8',
            'Ι' => 'I',
            'Κ' => 'K',
            'Λ' => 'L',
            'Μ' => 'M',
            'Ν' => 'N',
            'Ξ' => '3',
            'Ο' => 'O',
            'Π' => 'P',
            'Ρ' => 'R',
            'Σ' => 'S',
            'Τ' => 'T',
            'Υ' => 'Y',
            'Φ' => 'F',
            'Χ' => 'X',
            'Ψ' => 'PS',
            'Ω' => 'W',
            'Ά' => 'A',
            'Έ' => 'E',
            'Ί' => 'I',
            'Ό' => 'O',
            'Ύ' => 'Y',
            'Ή' => 'H',
            'Ώ' => 'W',
            'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a',
            'β' => 'b',
            'γ' => 'g',
            'δ' => 'd',
            'ε' => 'e',
            'ζ' => 'z',
            'η' => 'h',
            'θ' => '8',
            'ι' => 'i',
            'κ' => 'k',
            'λ' => 'l',
            'μ' => 'm',
            'ν' => 'n',
            'ξ' => '3',
            'ο' => 'o',
            'π' => 'p',
            'ρ' => 'r',
            'σ' => 's',
            'τ' => 't',
            'υ' => 'y',
            'φ' => 'f',
            'χ' => 'x',
            'ψ' => 'ps',
            'ω' => 'w',
            'ά' => 'a',
            'έ' => 'e',
            'ί' => 'i',
            'ό' => 'o',
            'ύ' => 'y',
            'ή' => 'h',
            'ώ' => 'w',
            'ς' => 's',
            'ϊ' => 'i',
            'ΰ' => 'y',
            'ϋ' => 'y',
            'ΐ' => 'i',

            // Turkish
            'Ş' => 'S',
            'İ' => 'I',
            'Ç' => 'C',
            'Ü' => 'U',
            'Ö' => 'O',
            'Ğ' => 'G',
            'ş' => 's',
            'ı' => 'i',
            'ç' => 'c',
            'ü' => 'u',
            'ö' => 'o',
            'ğ' => 'g',

            // Russian
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'Yo',
            'Ж' => 'Zh',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'J',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sh',
            'Ъ' => '',
            'Ы' => 'Y',
            'Ь' => '',
            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'j',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sh',
            'ъ' => '',
            'ы' => 'y',
            'ь' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',

            // Ukrainian
            'Є' => 'Ye',
            'І' => 'I',
            'Ї' => 'Yi',
            'Ґ' => 'G',
            'є' => 'ye',
            'і' => 'i',
            'ї' => 'yi',
            'ґ' => 'g',

            // Czech
            'Č' => 'C',
            'Ď' => 'D',
            'Ě' => 'E',
            'Ň' => 'N',
            'Ř' => 'R',
            'Š' => 'S',
            'Ť' => 'T',
            'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c',
            'ď' => 'd',
            'ě' => 'e',
            'ň' => 'n',
            'ř' => 'r',
            'š' => 's',
            'ť' => 't',
            'ů' => 'u',
            'ž' => 'z',

            // Polish
            'Ą' => 'A',
            'Ć' => 'C',
            'Ę' => 'e',
            'Ł' => 'L',
            'Ń' => 'N',
            'Ó' => 'o',
            'Ś' => 'S',
            'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a',
            'ć' => 'c',
            'ę' => 'e',
            'ł' => 'l',
            'ń' => 'n',
            'ó' => 'o',
            'ś' => 's',
            'ź' => 'z',
            'ż' => 'z',

            // Latvian
            'Ā' => 'A',
            'Č' => 'C',
            'Ē' => 'E',
            'Ģ' => 'G',
            'Ī' => 'i',
            'Ķ' => 'k',
            'Ļ' => 'L',
            'Ņ' => 'N',
            'Š' => 'S',
            'Ū' => 'u',
            'Ž' => 'Z',
            'ā' => 'a',
            'č' => 'c',
            'ē' => 'e',
            'ģ' => 'g',
            'ī' => 'i',
            'ķ' => 'k',
            'ļ' => 'l',
            'ņ' => 'n',
            'š' => 's',
            'ū' => 'u',
            'ž' => 'z',
        ];

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ?: mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }
}
