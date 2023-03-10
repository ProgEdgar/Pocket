<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\AniManga;
use common\models\Api;
use yii\data\Sort;

/**
 * MangaController implements the CRUD actions for Manga model.
 */
class MangaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * Displays a single Manga model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('manga');
    }

    /**
     * Displays api manga.
     *
     * @return mixed
     */
    public function actionApimanga($IdApi, $IdManga)
    {
        $Api = Api::find()->where(['IdApi'=>$IdApi])->one();
        $Link = str_replace('{am_id}', $IdManga ,$Api->AMLink);
        $Manga = $Api->animanga;
        $Favorite = false;
        $Library = false;
        $JavaApi = false;

        if(!Yii::$app->user->isGuest && $Manga){
            $Favorites = Yii::$app->user->identity->favorites;
            $Libraries = Yii::$app->user->identity->libraries;
            if($Favorites){
                foreach($Favorites as $Fav){
                    if($Fav->Manga_Id == $Manga->IdManga){
                        $Favorite = true;
                    }
                }
            }
            if($Libraries){
                foreach($Libraries as $Lib){
                    if($Lib->Manga_Id == $Manga->IdManga){
                        $Library = true;
                    }
                }
            }
        }

        if($Api){
            $JavaApi = '{';
            $num = 0;
            foreach($Api as $key=>$value){
                if($num!=0){
                    $JavaApi .= ',';
                }
                $JavaApi .= '"'.$key.'":'.(isset($value)?'"'.$value.'"':'null');
                $num++;
            }
            $JavaApi .= '}';
        }
        return $this->render('api_manga_view', [
            'Api' => $Api,
            'JavaApi' => $JavaApi,
            'Link' => $Link,
            'IdManga' => $IdManga,
            'Favorite' => $Favorite,
            'Library' => $Library,
        ]);
    }

    /**
     * Displays api mangas list.
     *
     * @return mixed
     */
    public function actionApimangalist()
    {
        $Api = null;
        $SortOptions = null;
        $StatusOptions = null;
        $TypeOptions = null;
        $PageNumber = 1;
        $NumOfPages = 10;


        if(!Yii::$app->user->isGuest){
            if(Yii::$app->user->identity->Api_Id){
                $Api = Api::find()->where(['IdApi'=>Yii::$app->user->identity->Api_Id])->one();
            }else{
                $AllApi = Api::find()->all();
                if($AllApi){
                    $Api = $AllApi[0];
                }
            }
        }

        $Api = Api::find()->where(['IdApi'=>1])->one();

        if($Api){
            $SortOptions = $this->getSortOptions($Api);
            $StatusOptions = $this->getStatusOptions($Api);
            $TypeOptions = $this->getTypeOptions($Api);

            $JavaApi = '{';
            $num = 0;
            foreach($Api as $key=>$value){
                if($num!=0){
                    $JavaApi .= ',';
                }
                $JavaApi .= '"'.$key.'":'.(isset($value)?'"'.$value.'"':'null');
                $num++;
            }
            $JavaApi .= '}';
        }

        return $this->render('other_manga', [
            'Api' => $Api,
            'JavaApi' => $JavaApi,
            'SortOptions' => $SortOptions,
            'StatusOptions' => $StatusOptions,
            'TypeOptions' => $TypeOptions,
            'PageNumber' => $PageNumber,
            'NumOfPages' => $NumOfPages,
        ]);
    }

    private function getSortOptions(Api $Api){
        $Order=null;
        $Sort=null;
        $SortOptions = null;
        if($Api->AMSortByOptions){
            $Order = explode('[',str_replace(']','',$Api->AMOrderByOptions));
            array_shift($Order);
        }
        if($Api->AMSortByOptions){
            $Sort = explode('[',str_replace(']','',$Api->AMSortByOptions));
            array_shift($Sort);
        }
        if($Order){
            if($Sort){
                foreach($Order as $order){
                    foreach($Sort as $sort){
                        $Option[0]=explode('=>', $order)[0].'=='.explode('=>', $sort)[0];
                        $Option[1]=explode('=>', $order)[1].' '.explode('=>', $sort)[1];
                        $SortOptions[]=$Option;
                    }
                }
            }else{
                foreach($Order as $order){
                    $SortOptions[]=explode('=>', $order);
                }
            }
        }
        return $SortOptions;
    }

    private function getStatusOptions(Api $Api){
        $Status=null;
        $StatusOptions = null;
        if($Api->AMStatusOptions){
            $Status = explode('[',str_replace(']','',$Api->AMStatusOptions));
            array_shift($Status);
        }
        if($Status){
            foreach($Status as $status){
                $StatusOptions[]=explode('=>', $status);
            }
        }
        return $StatusOptions;
    }

    private function getTypeOptions(Api $Api){
        $Type=null;
        $TypeOptions = null;
        if($Api->AMTypeOptions){
            $Type = explode('[',str_replace(']','',$Api->AMTypeOptions));
            array_shift($Type);
        }
        if($Type){
            foreach($Type as $type){
                $TypeOptions[]=explode('=>', $type);
            }
        }
        return $TypeOptions;
    }
}
