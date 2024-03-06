# 目次

- [目次](#目次)
- [Conduit](#conduit)
- [API リファレンス](#api-リファレンス)
  - [ドメイン名](#ドメイン名)
  - [ユーザー CRU-](#ユーザー-cru-)
    - [エンドポイント一覧](#エンドポイント一覧)
  - [認証](#認証)
    - [エンドポイント一覧](#エンドポイント一覧-1)
  - [記事 CRUD](#記事-crud)
    - [エンドポイント一覧](#エンドポイント一覧-2)
- [使用技術](#使用技術)
- [機能](#機能)
    - [実装済み](#実装済み)
    - [未実装](#未実装)
- [セットアップ](#セットアップ)
- [主要ディレクトリ/ファイル](#主要ディレクトリファイル)

# Conduit

ブログプラットフォームを作る [RealWorld](https://github.com/gothinkster/realworld/tree/main) という OSS のプロジェクトがあります。RealWorld は実世界と同じ機能を持つプラットフォームを作ることで、学習したいフレームワークの技術を習得することを目的としたプロジェクトです。

Conduit は [RealWorld](https://demo.realworld.io/#/) で作成する Medium.com のクローンサイトです。
詳細な仕様については [Specs/Backend Specs](https://realworld-docs.netlify.app/docs/specs/backend-specs/introduction), [Specs/Frontend Specs](https://realworld-docs.netlify.app/docs/specs/frontend-specs/templates)で確認できます。

今回は Conduit と同じ見た目・機能のサイトを `Laravel API` で実装しています。

フロントエンドのディレクトリは[こちら](https://github.com/suzuk12345/realworld_conduit_nextjs)

# API リファレンス

## ドメイン名

```
https://suzuki-test.xyz
```

## ユーザー CRU-

### エンドポイント一覧

| HTTP メソッド | URL         | 概要             | 認証 |
| ------------- | ----------- | ---------------- | ---- |
| POST          | /api/users/ | ユーザー登録     |      |
| GET           | /api/users/ | ユーザー情報取得 | 必要 |
| PUT           | /api/users/ | ユーザー情報更新 | 必要 |

<details>
<summary>ユーザー登録</summary>

`POST /api/users/`

-   リクエストヘッダー

    `必須` `Content-Type: application/json`

-   リクエストボディ例

    `必須項目`:`email`, `password`, `username`

    ```
    {
        "user":{
            "email": "test@test.com",
            "password": "password",
            "username": "test"
        }
    }
    ```

-   レスポンスボディ例

    ```
    {
        "user": {
            "email": "test@test.com",
            "token": "token",
            "username": "test",
            "bio": null,
            "image": "default_image.png"
        }
    }
    ```

</details>

<details>
<summary>ユーザー情報取得</summary>

`GET /api/users/`

-   リクエストヘッダー

    `必須` `Authorization: Bearer jwt.token.here`

-   レスポンスボディ例

    ```
    {
        "user": {
            "email": "test@test.com",
            "token": "token",
            "username": "test",
            "bio": null,
            "image": "default_image.png"
        }
    }
    ```

</details>

<details>
<summary>ユーザー情報更新</summary>

`PUT /api/users/`

-   リクエストヘッダー

    `必須` `Authorization: Bearer jwt.token.here`

    `必須` `Content-Type: application/json`

-   リクエストボディ例

    `必須項目`:`email`, `password`, `username`, `bio`, `image`

    ```
    {
        "user": {
            "email": "test@test.com",
            "token": "token",
            "username": "test",
            "bio": "test bio",
            "image": "default_image.png"
        }
    }
    ```

-   レスポンスボディ例

    ```
    {
        "user": {
            "email": "test@test.com",
            "token": "token",
            "username": "test",
            "bio": "test bio",
            "image": "default_image.png"
        }
    }
    ```

    </details>

## 認証

### エンドポイント一覧

| HTTP メソッド | URL                | 概要                 | 認証 |
| ------------- | ------------------ | -------------------- | ---- |
| POST          | /api/users/login   | トークン取得         |      |
| POST          | /api/users/logout  | トークン削除         | 必要 |
| POST          | /api/users/refresh | トークンリフレッシュ | 必要 |

<details>
<summary>トークン取得</summary>

`POST /api/users/login`

-   リクエストヘッダー

    `必須` `Content-Type: application/json`

-   リクエストボディ例

    `必須項目`:`email`, `password`

    ```
    {
        "user":{
            "email": "test@test.com",
            "password": "password"
        }
    }
    ```

-   レスポンスボディ例

    ```
    {
        "user": {
            "email": "test@test.com",
            "token": "token",
            "username": "test",
            "bio": null,
            "image": "default_image.png"
        }
    }
    ```

</details>

<details>
<summary>トークン削除</summary>

`POST /api/users/logout`

-   リクエストヘッダー

    `必須` `Authorization: Bearer jwt.token.here`

-   レスポンスボディ例

    ```
    {
        "message" => "ログアウトしました。"
    }
    ```

</details>

<details>
<summary>トークンリフレッシュ</summary>

`POST /api/users/refresh`

-   リクエストヘッダー

    `必須` `Authorization: Bearer jwt.token.here`

-   レスポンスボディ例

    ```
    {
        "user": {
            "email": "test@test.com",
            "token": "token",
            "username": "test",
            "bio": null,
            "image": "default_image.png"
        }
    }
    ```

    </details>

## 記事 CRUD

### エンドポイント一覧

| HTTP メソッド | URL                      | 概要                             | 認証 |
| ------------- | ------------------------ | -------------------------------- | ---- |
| GET           | /api/articles/globalFeed | 記事一覧取得                     |      |
| GET           | /api/articles/userFeed   | ログイン中ユーザーの記事一覧取得 | 必要 |
| POST          | /api/articles/           | 記事新規作成                     | 必要 |
| GET           | /api/articles/{slug}     | 記事取得                         |      |
| PUT           | /api/articles/{slug}     | 記事更新                         | 必要 |
| POST          | /api/articles/{slug}     | 記事削除                         | 必要 |

<details>
<summary>記事一覧取得</summary>

`GET /api/articles/globalFeed

-   クエリパラメータ

    任意 `page`: 取得するページ番号。1 以上を指定。

    例 `/api/articles/globalFeed?page=2`

-   レスポンスボディ例

    ```
    {
        "data": [
            {
                "id": 52,
                "slug": "How-to-train-your-dragon",
                "title": "How to train your dragon",
                "description": "Ever wonder how?",
                "body": "Very carefully.",
                "tagList": [
                    "training",
                    "dragons"
                ],
                "created_at": "2024-03-06T08:37:36.000000Z",
                "updated_at": "2024-03-06T08:37:36.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            },
            {
                "id": 50,
                "slug": "Mouse's-tail;-'but-why-do-you-want-to-be?'-it-asked.-'Oh,-I'm.",
                "title": "Mouse's tail; 'but why do you want to be?' it asked. 'Oh, I'm.",
                "description": "And she tried to look at them--'I wish they'd get the trial.",
                "body": "While the Duchess by this time, as it went. So she began: 'O Mouse, do you mean \"purpose\"?' said Alice. 'Come, let's try Geography. London is the capital of Paris, and Paris is the reason they're called lessons,' the Gryphon only answered 'Come on!' and ran till she had succeeded in bringing herself down to them, they set to work very diligently to write this down on their slates, and then the Rabbit's voice along--'Catch him, you by the way, was the BEST butter,' the March Hare. The Hatter was the White Rabbit. She was a large cauldron which seemed to be two people! Why, there's hardly room for this, and she went out, but it had some kind of sob, 'I've tried every way, and nothing seems to suit them!' 'I haven't the slightest idea,' said the Cat. 'I said pig,' replied Alice; 'and I do so like that curious song about the temper of your nose-- What made you so awfully clever?' 'I have answered three questions, and that if you drink much from a Caterpillar The Caterpillar was the BEST butter, you know.' 'I.",
                "tagList": [
                    "ddd",
                    "aaa"
                ],
                "created_at": "2024-02-28T02:04:46.000000Z",
                "updated_at": "2024-02-28T02:04:46.000000Z",
                "author": {
                    "username": "suzuki",
                    "bio": null,
                    "image": "default_image.png"
                }
            },
            {
                "id": 49,
                "slug": "Then-it-got-down-off-the-subjects-on-his-flappers,-'--Mystery.",
                "title": "Then it got down off the subjects on his flappers, '--Mystery.",
                "description": "And oh, my poor little Lizard, Bill, was in the act of.",
                "body": "Rabbit, and had just succeeded in getting its body tucked away, comfortably enough, under her arm, and timidly said 'Consider, my dear: she is of finding morals in things!' Alice began to repeat it, when a sharp hiss made her next remark. 'Then the eleventh day must have been changed several times since then.' 'What do you like the look of the month is it?' 'Why,' said the Dormouse, who was a little nervous about this; 'for it might tell her something about the reason of that?' 'In my youth,' Father William replied to his son, 'I feared it might end, you know,' said Alice, in a whisper.) 'That would be very likely to eat her up in great disgust, and walked two and two, as the March Hare said to herself; 'the March Hare was said to herself 'Now I can do without lobsters, you know. Come on!' 'Everybody says \"come on!\" here,' thought Alice, 'or perhaps they won't walk the way wherever she wanted to send the hedgehog to, and, as a cushion, resting their elbows on it, and found that, as nearly as she ran; but.",
                "tagList": [
                    "ddd",
                    "aaa",
                    "eee"
                ],
                "created_at": "2024-02-28T02:04:46.000000Z",
                "updated_at": "2024-02-28T02:04:46.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            },
            {
                "id": 48,
                "slug": "I'm-here!-Digging-for-apples,-yer-honour!'-(He-pronounced-it.",
                "title": "I'm here! Digging for apples, yer honour!' (He pronounced it.",
                "description": "Cheshire cat,' said the Queen, who was passing at the Cat's.",
                "body": "ARE OLD, FATHER WILLIAM,\"' said the Hatter. He had been for some minutes. The Caterpillar was the BEST butter, you know.' 'Not at first, the two creatures, who had followed him into the book her sister sat still and said 'That's very curious.' 'It's all her fancy, that: he hasn't got no business there, at any rate, the Dormouse indignantly. However, he consented to go on crying in this way! Stop this moment, I tell you, you coward!' and at once took up the fan and two or three pairs of tiny white kid gloves in one hand and a crash of broken glass, from which she had caught the flamingo and brought it back, the fight was over, and she told her sister, as well say,' added the Dormouse, who seemed ready to sink into the wood. 'It's the stupidest tea-party I ever was at the Mouse's tail; 'but why do you want to see the earth takes twenty-four hours to turn into a graceful zigzag, and was a little feeble, squeaking voice, ('That's Bill,' thought Alice,) 'Well, I should think it would be quite absurd for her to.",
                "tagList": [
                    "aaa"
                ],
                "created_at": "2024-02-28T02:04:46.000000Z",
                "updated_at": "2024-02-28T02:04:46.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            },
            {
                "id": 47,
                "slug": "But-her-sister-was-reading,-but-it-was-growing,-and-she-could.",
                "title": "But her sister was reading, but it was growing, and she could.",
                "description": "Dormouse,' the Queen to play with, and oh! ever so many.",
                "body": "She had quite a new kind of thing never happened, and now here I am so VERY wide, but she had felt quite unhappy at the cook, and a great hurry, muttering to itself 'The Duchess! The Duchess! Oh my dear Dinah! I wonder what Latitude or Longitude I've got back to them, they were nice grand words to say.) Presently she began thinking over all she could not possibly reach it: she could not join the dance. '\"What matters it how far we go?\" his scaly friend replied. \"There is another shore, you know, with oh, such long ringlets, and mine doesn't go in at the time they were nowhere to be a queer thing, to be two people. 'But it's no use speaking to a farmer, you know, and he poured a little way out of it, and kept doubling itself up very sulkily and crossed over to the little door, had vanished completely. Very soon the Rabbit just under the window, and on both sides at once. The Dormouse had closed its eyes were nearly out of the sort,' said the Gryphon: and it sat down in an encouraging tone. Alice looked at.",
                "tagList": [
                    "ddd"
                ],
                "created_at": "2024-02-28T02:04:46.000000Z",
                "updated_at": "2024-02-28T02:04:46.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            }
        ],
        "links": {
            "first": "http://suzuki-test.xyz/api/articles/globalFeed?page=1",
            "last": "http://suzuki-test.xyz/api/articles/globalFeed?page=11",
            "prev": null,
            "next": "http://suzuki-test.xyz/api/articles/globalFeed?page=2"
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 11,
            "links": [
                {
                    "url": null,
                    "label": "&laquo; 前",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=1",
                    "label": "1",
                    "active": true
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=2",
                    "label": "2",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=3",
                    "label": "3",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=4",
                    "label": "4",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=5",
                    "label": "5",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=6",
                    "label": "6",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=7",
                    "label": "7",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=8",
                    "label": "8",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=9",
                    "label": "9",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=10",
                    "label": "10",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=11",
                    "label": "11",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/globalFeed?page=2",
                    "label": "次 &raquo;",
                    "active": false
                }
            ],
            "path": "http://suzuki-test.xyz/api/articles/globalFeed",
            "per_page": 5,
            "to": 5,
            "total": 51
        }
    }
    ```

    ```

    ```

</details>

<details>
<summary>ログイン中ユーザーの記事一覧取得</summary>

`GET /api/articles/userFeed`

-   クエリパラメータ

    任意 `page`: 取得するページ番号。 1 以上を指定。

    例 `/api/articles/userFeed?page=2`

-   リクエストヘッダー

    `必須` `Authorization: Bearer jwt.token.here`

-   レスポンスボディ例

    ```
    {
        "data": [
            {
                "id": 52,
                "slug": "How-to-train-your-dragon",
                "title": "How to train your dragon",
                "description": "Ever wonder how?",
                "body": "Very carefully.",
                "tagList": [
                    "training",
                    "dragons"
                ],
                "created_at": "2024-03-06T08:37:36.000000Z",
                "updated_at": "2024-03-06T08:37:36.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            },
            {
                "id": 49,
                "slug": "Then-it-got-down-off-the-subjects-on-his-flappers,-'--Mystery.",
                "title": "Then it got down off the subjects on his flappers, '--Mystery.",
                "description": "And oh, my poor little Lizard, Bill, was in the act of.",
                "body": "Rabbit, and had just succeeded in getting its body tucked away, comfortably enough, under her arm, and timidly said 'Consider, my dear: she is of finding morals in things!' Alice began to repeat it, when a sharp hiss made her next remark. 'Then the eleventh day must have been changed several times since then.' 'What do you like the look of the month is it?' 'Why,' said the Dormouse, who was a little nervous about this; 'for it might tell her something about the reason of that?' 'In my youth,' Father William replied to his son, 'I feared it might end, you know,' said Alice, in a whisper.) 'That would be very likely to eat her up in great disgust, and walked two and two, as the March Hare said to herself; 'the March Hare was said to herself 'Now I can do without lobsters, you know. Come on!' 'Everybody says \"come on!\" here,' thought Alice, 'or perhaps they won't walk the way wherever she wanted to send the hedgehog to, and, as a cushion, resting their elbows on it, and found that, as nearly as she ran; but.",
                "tagList": [
                    "ddd",
                    "aaa",
                    "eee"
                ],
                "created_at": "2024-02-28T02:04:46.000000Z",
                "updated_at": "2024-02-28T02:04:46.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            },
            {
                "id": 48,
                "slug": "I'm-here!-Digging-for-apples,-yer-honour!'-(He-pronounced-it.",
                "title": "I'm here! Digging for apples, yer honour!' (He pronounced it.",
                "description": "Cheshire cat,' said the Queen, who was passing at the Cat's.",
                "body": "ARE OLD, FATHER WILLIAM,\"' said the Hatter. He had been for some minutes. The Caterpillar was the BEST butter, you know.' 'Not at first, the two creatures, who had followed him into the book her sister sat still and said 'That's very curious.' 'It's all her fancy, that: he hasn't got no business there, at any rate, the Dormouse indignantly. However, he consented to go on crying in this way! Stop this moment, I tell you, you coward!' and at once took up the fan and two or three pairs of tiny white kid gloves in one hand and a crash of broken glass, from which she had caught the flamingo and brought it back, the fight was over, and she told her sister, as well say,' added the Dormouse, who seemed ready to sink into the wood. 'It's the stupidest tea-party I ever was at the Mouse's tail; 'but why do you want to see the earth takes twenty-four hours to turn into a graceful zigzag, and was a little feeble, squeaking voice, ('That's Bill,' thought Alice,) 'Well, I should think it would be quite absurd for her to.",
                "tagList": [
                    "aaa"
                ],
                "created_at": "2024-02-28T02:04:46.000000Z",
                "updated_at": "2024-02-28T02:04:46.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            },
            {
                "id": 47,
                "slug": "But-her-sister-was-reading,-but-it-was-growing,-and-she-could.",
                "title": "But her sister was reading, but it was growing, and she could.",
                "description": "Dormouse,' the Queen to play with, and oh! ever so many.",
                "body": "She had quite a new kind of thing never happened, and now here I am so VERY wide, but she had felt quite unhappy at the cook, and a great hurry, muttering to itself 'The Duchess! The Duchess! Oh my dear Dinah! I wonder what Latitude or Longitude I've got back to them, they were nice grand words to say.) Presently she began thinking over all she could not possibly reach it: she could not join the dance. '\"What matters it how far we go?\" his scaly friend replied. \"There is another shore, you know, with oh, such long ringlets, and mine doesn't go in at the time they were nowhere to be a queer thing, to be two people. 'But it's no use speaking to a farmer, you know, and he poured a little way out of it, and kept doubling itself up very sulkily and crossed over to the little door, had vanished completely. Very soon the Rabbit just under the window, and on both sides at once. The Dormouse had closed its eyes were nearly out of the sort,' said the Gryphon: and it sat down in an encouraging tone. Alice looked at.",
                "tagList": [
                    "ddd"
                ],
                "created_at": "2024-02-28T02:04:46.000000Z",
                "updated_at": "2024-02-28T02:04:46.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            },
            {
                "id": 46,
                "slug": "I'll-eat-it,'-said-Five,-in-a-low-voice,-'Your-Majesty-must.",
                "title": "I'll eat it,' said Five, in a low voice, 'Your Majesty must.",
                "description": "Don't let me hear the Rabbit whispered in a minute or two.",
                "body": "Alice would not join the dance? Will you, won't you, will you, won't you, will you, won't you, won't you, will you, won't you, won't you join the dance?\"' 'Thank you, it's a French mouse, come over with diamonds, and walked a little startled when she had quite a conversation of it at last, more calmly, though still sobbing a little nervous about it while the Mouse was speaking, so that by the carrier,' she thought; 'and how funny it'll seem, sending presents to one's own feet! And how odd the directions will look! ALICE'S RIGHT FOOT, ESQ. HEARTHRUG, NEAR THE FENDER, (WITH ALICE'S LOVE). Oh dear, what nonsense I'm talking!' Just then she walked down the bottle, saying to herself, 'Now, what am I to do?' said Alice. 'Nothing WHATEVER?' persisted the King. 'Then it wasn't very civil of you to learn?' 'Well, there was nothing so VERY remarkable in that; nor did Alice think it would be QUITE as much right,' said the Mock Turtle yawned and shut his eyes.--'Tell her about the whiting!' 'Oh, as to bring tears into.",
                "tagList": [
                    "bbb"
                ],
                "created_at": "2024-02-28T02:04:46.000000Z",
                "updated_at": "2024-02-28T02:04:46.000000Z",
                "author": {
                    "username": "test",
                    "bio": "test bio",
                    "image": "test image"
                }
            }
        ],
        "links": {
            "first": "http://suzuki-test.xyz/api/articles/userFeed?page=1",
            "last": "http://suzuki-test.xyz/api/articles/userFeed?page=5",
            "prev": null,
            "next": "http://suzuki-test.xyz/api/articles/userFeed?page=2"
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 5,
            "links": [
                {
                    "url": null,
                    "label": "&laquo; 前",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/userFeed?page=1",
                    "label": "1",
                    "active": true
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/userFeed?page=2",
                    "label": "2",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/userFeed?page=3",
                    "label": "3",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/userFeed?page=4",
                    "label": "4",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/userFeed?page=5",
                    "label": "5",
                    "active": false
                },
                {
                    "url": "http://suzuki-test.xyz/api/articles/userFeed?page=2",
                    "label": "次 &raquo;",
                    "active": false
                }
            ],
            "path": "http://suzuki-test.xyz/api/articles/userFeed",
            "per_page": 5,
            "to": 5,
            "total": 25
        }
    }
    ```

</details>

<details>
<summary>記事新規作成</summary>

`POST /api/articles/`

-   リクエストヘッダー

    `必須` `Authorization: Bearer jwt.token.here`

    `必須` `Content-Type: application/json`

-   リクエストボディ例

    `必須項目`:`title`, `description`, `body`

    任意項目:`tagList`

    ```
    {
        "article": {
            "title": "How to train your dragon",
            "description": "Ever wonder how?",
            "body": "Very carefully.",
            "tagList": [
                "training",
                "dragons"
            ],
        }
    }
    ```

-   レスポンスボディ例

    ```
    {
        "article": {
            "slug": "How-to-train-your-dragon",
            "title": "How to train your dragon",
            "description": "Ever wonder how?",
            "body": "Very carefully.",
            "tagList": [
                "training",
                "dragons"
            ],
            "created_at": "2024-03-06T08:37:36.000000Z",
            "updated_at": "2024-03-06T08:37:36.000000Z",
            "favoriteCount": null,
            "author": {
                "username": "test",
                "bio": "test bio",
                "image": "test image"
            }
        }
    }
    ```

</details>

<details>
<summary>記事取得</summary>

`GET /api/articles/{slug}`

-   レスポンスボディ例

    ```
    {
        "article": {
            "slug": "How-to-train-your-dragon",
            "title": "How to train your dragon",
            "description": "Ever wonder how?",
            "body": "Very carefully.",
            "tagList": [
                "training",
                "dragons"
            ],
            "created_at": "2024-03-06T08:37:36.000000Z",
            "updated_at": "2024-03-06T08:37:36.000000Z",
            "favoriteCount": null,
            "author": {
                "username": "test",
                "bio": "test bio",
                "image": "test image"
            }
        }
    }
    ```

</details>

<details>
<summary>記事更新</summary>

`PUT /api/articles/{slug}`

-   リクエストヘッダー

    `必須` `Authorization: Bearer jwt.token.here`

    `必須` `Content-Type: application/json`

-   リクエストボディ例

    `必須項目`:`title`, `description`, `body`

    ```
    {
        "article": {
            "title": "How to train your dragon",
            "description": "Ever wonder how?",
            "body": "With two hands",
        }
    }
    ```

-   レスポンスボディ例

    ```
    {
        "article": {
            "slug": "How-to-train-your-dragon",
            "title": "How to train your dragon",
            "description": "Ever wonder how?",
            "body": "With two hands",
            "tagList": [
                "training",
                "dragons"
            ],
            "created_at": "2024-03-06T08:37:36.000000Z",
            "updated_at": "2024-03-06T08:37:36.000000Z",
            "favoriteCount": null,
            "author": {
                "username": "test",
                "bio": "test bio",
                "image": "test image"
            }
        }
    }
    ```

</details>

<details>
<summary>記事削除</summary>

`POST /api/articles/{slug}`

-   リクエストヘッダー

    `必須` `Authorization: Bearer jwt.token.here`

-   レスポンスボディ例

    ```
    {
        "message" => "記事の削除に成功しました。"
    }
    ```

</details>

# 使用技術

-   PHP 8.2.14
-   Laravel 10.38.2
-   MySQL 8.0.32

# 機能

### 実装済み

-   JWT 認証
-   ユーザー CRU-
-   記事 CRUD
-   タグ機能
-   ダミー生成
-   記事一覧ページネーション

### 未実装

-   記事へのコメント CR-D
-   記事お気に入り
-   記事マークダウン反映
-   ユーザーフォロー
-   テスト
-   バリデーション

# セットアップ

PHP と Composer がコンピュータにグローバルにインストールされていることを確認してください。

リポジトリのクローンを作成し、プロジェクトフォルダーに移動

```bash
git clone https://github.com/suzuk12345/RealWorld_Conduit.git
cd RealWorld_Conduit
```

composer install/.env 作成

```bash
composer install
cp .env.example .env
```

コンテナ起動/キー生成

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
```

任意) sail コマンドの Bash エイリアスを構成

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

セットアップ完了 API や phpMyAdmin にアクセスできます。

-   phpMyAdmin
    http://localhost:8080/

# 主要ディレクトリ/ファイル

-   Model
    -   [app/Models/User.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Models/User.php)
    -   [app/Models/Article.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Models/Article.php)
-   Migration
    -   [migrations/create_users_table.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/database/migrations/2014_10_12_000000_create_users_table.php)
    -   [migrations/create_conduit_articles_table.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/master/database/migrations/2023_12_23_113214_create_conduit_articles_table.php)
-   Controller
    -   [app/Http/Controllers/AuthController.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Http/Controllers/AuthController.php)
    -   [app/Http/Controllers/UserController.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Http/Controllers/UserController.php)
    -   [app/Http/Controllers/ArticleController.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Http/Controllers/ArticleController.php)
-   Route
    -   [routes/api.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/routes/api.php)
-   Postman ([オリジナル](https://github.com/gothinkster/realworld/blob/main/api/Conduit.postman_collection.json)を参考に実装済みの部分のみに修正)
    -   [Conduit.postman_collection.json](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/Conduit.postman_collection.json)
