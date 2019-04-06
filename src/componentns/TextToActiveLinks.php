<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\textToActiveLinks\components;

use yii\base\Component;
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class TextToActiveLinks extends Component
{

    /**
     * @var Maximum length of displayed short link
     */
    public $short_link_max_length = 45;

    /**
     * @param $text
     * @return null|string|string[]
     */
    public function correct($text)
    {
        $text = preg_replace("!<a.*?href=\"?'?http:\/\/([^ \"'>]+)\"?'?.*?>(.*?)</a>!is", "\\2", $text);
        $text = preg_replace("!<a.*?href=\"?'?https:\/\/([^ \"'>]+)\"?'?.*?>(.*?)</a>!is", "\\2", $text);
        /*return $text;*/
        //return preg_replace_callback('#(http|https|ftp|ftps|www)([://]|[\.])[^\s]+#ui', [$this, '_shortLink'], $text);
        return preg_replace_callback('/(((http|ftp|https):\/{2})+(([0-9a-z_-]+\.)+(aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mn|mn|mo|mp|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|nom|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ra|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|arpa)(:[0-9]+)?((\/([~0-9a-zA-Z\#\+\%@\.\/_-]+))?(\?[0-9a-zA-Z\+\%@\/&\[\];=_-]+)?)?))\b/imuS', [$this, '_shortLink'], $text);
        //return preg_replace_callback("_(^|[\s.:;?\-\]<\(])(https?://[-\w;/?:@&=+$\|\_.!~*\|'()\[\]%#,☺]+[\w/#](\(\))?)(?=$|[\s',\|\(\).:;?\-\[\]>\)])_i", [$this, '_shortLink'], $text);
        //return preg_replace_callback("#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#iS", [$this, '_shortLink'], $text);
        $reg = <<<TXT
_^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/[^\s]*)?$_iuS
TXT;

        return preg_replace_callback($reg, [$this, '_shortLink'], $text);
    }

    /**
     * @param $matches
     * @return string
     */
    private function _shortLink($matches)
    {
        $linkText = $matches[0];
        $linkData = parse_url($matches[0]);

        if (mb_strlen($linkText) > $this->short_link_max_length) {
            $linkText = mb_substr($linkText, 0, $this->short_link_max_length)."..";
        }
        if (preg_match('#(http|https|ftp|ftps)://[^\s]+#ui', $matches[0])) {

            $matches[0] = strip_tags($matches[0]);
            return '<a href="'.$matches[0].'" target="_blank" data-pjax="0" title="'.$matches[0].'">'.$linkText.'</a>';
        } else {

            $matches[0] = strip_tags($matches[0]);
            return '<a href="http://'.$matches[0].'" target="_blank" data-pjax="0" title="'.$matches[0].'">'.$linkText.'</a>';
        }
    }
}