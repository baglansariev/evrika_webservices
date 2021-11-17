<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creatio Bonuses</title>
    <link rel="stylesheet" href="{{ asset('css/creatio-form.css') }}">
</head>
<body>

    <section class="main-form">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="form-container mt-5">
                        <div class="card">
                            <div class="card-header">
                                <p class="text-center">Проверка бонусов</p>
                            </div>
                            <div class="card-body">
                                <form action="" class="bonus-form mb-5" style="width: 100%;">
                                    <div class="form-row mb-4">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="bonusNumber">Номер телефона или карты</label>
                                                <input type="number" id="bonusNumber" class="form-control" name="number" value="{{ request('number') ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="form-group text-center">
                                                <button class="btn btn-lg btn-success" type="submit">Проверить</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @if(isset($bonus_result) && !empty($bonus_result) && !isset($bonus_result['message']))
                                    <div class="bonus-info-block">
                                        <div class="block-row d-flex">
                                            <div class="block-col">Ф.И.О рользователя</div>
                                            <div class="block-col">{{ $bonus_result['name'] ?? '' }}</div>
                                        </div>
                                        <div class="block-row d-flex">
                                            <div class="block-col">Дата рождения</div>
                                            <div class="block-col">{{ $bonus_result['birthday'] ?? '' }}</div>
                                        </div>
                                        <div class="block-row d-flex">
                                            <div class="block-col">Кол-во бонусов (активные)</div>
                                            <div class="block-col">{{ $bonus_result['available'] ?? '' }}</div>
                                        </div>
                                        <div class="block-row d-flex">
                                            <div class="block-col">Кол-во бонусов (не активные)</div>
                                            <div class="block-col">{{ $bonus_result['blocked'] ?? '' }}</div>
                                        </div>
                                        <div class="block-row d-flex">
                                            <div class="block-col">Кол-во бонусов (общее)</div>
                                            <div class="block-col">{{ $bonus_result['balance'] ?? '' }}</div>
                                        </div>
                                    </div>
                                @elseif(isset($bonus_result['message']))
                                    <div class="bonus-info-block d-flex justify-content-center">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <span>{{ $bonus_result['message'] }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/creatio-form.js') }}"></script>
</body>
</html>