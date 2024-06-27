@extends('layouts.app')

@section('content')
    <div class="col-lg-8 offset-2">
        <div class="col-12 my-5 mx-2">
            <div class="card">
                <div class="card-body">
                    <h3> Messages </h3>
                    <hr>
                    <canvas id="messagesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 offset-2 pb-5">
        <div class="col-12 my-5 mx-2">
            <div class="card">
                <div class="card-body ">
                    <h3> Views </h3>
                    <hr>
                    <canvas id="viewsChart"></canvas>
                </div>
            </div>
        </div>
    </div>


    {{-- carico i file chart.js --}}
    <script src="http://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // MESSAGES
            // configurazione grafico
            const messagesCtx = document.getElementById('messagesChart').getContext('2d');

            // inserisco i dati per visualizzare il grafico
            const messagesData = {
                labels: ['January', 'February', 'March', 'April', 'May',
                    'June', 'July', 'August', 'September', 'October', 'November', 'December'
                ],
                datasets: [{
                    label: 'Massagges',
                    data: [2, 3, 4, 1, 6, 3, 2, 5, 6, 7, 2, 4],
                    backgroundColor: '#45C2B1',
                    borderColor: 'rgba(0 0 0 0.2)',
                    borderRadius: 20,
                    borderWidth: 1
                }]
            };

            // inserisco la configurazione del grafico
            const messagesConfig = {
                type: 'bar',
                data: messagesData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 17,
                                }
                            }
                        },
                        x: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 17,
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 18,
                                }
                            }
                        },
                    }
                }
            };

            // creazione del grafico
            new Chart(messagesCtx, messagesConfig);

            // VIEWS
            // configurazione grafico
            const viewsCtx = document.getElementById('viewsChart').getContext('2d');

            // inserisco i dati per visualizzare il grafico
            const viewsData = {
                labels: ['January', 'February', 'March', 'April', 'May',
                    'June', 'July', 'August', 'September', 'October', 'November', 'December'
                ],
                datasets: [{
                    label: 'Massagges',
                    data: [2, 3, 4, 1, 6, 3, 2, 5, 6, 7, 2, 4],
                    backgroundColor: '#809ef1',
                    borderColor: 'rgba(0 0 0 0.2)',
                    borderRadius: 20,
                    borderWidth: 1
                }]
            };

            // inserisco la configurazione del grafico
            const viewsConfig = {
                type: 'bar',
                data: viewsData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 17,
                                }
                            }
                        },
                        x: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 17,
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 18,
                                }
                            }
                        },
                    }
                }
            };

            // creazione del grafico
            new Chart(viewsCtx, viewsConfig);

        });
    </script>
@endsection
