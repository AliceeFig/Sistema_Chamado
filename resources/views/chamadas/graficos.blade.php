<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel de Controle') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-bold mb-4">Chamados - Gráficos</h2>

        <div class="bg-white p-4 rounded-lg shadow" style="max-height: 400px;">
            <canvas id="chamadosDiaChart"></canvas>
        </div>

        <div class="bg-white p-4 rounded-lg shadow mt-6" style="max-height: 400px;">
            <canvas id="chamadosSetorChart"></canvas>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let chamadosPorDia = @json($chamadosPorDia);
            let chamadosPorSetor = @json($chamadosPorSetor);

            console.log("Chamados por Dia:", chamadosPorDia);
            console.log("Chamados por Setor:", chamadosPorSetor);

            // Gráfico de Linha - Chamados por Dia
            if (Object.keys(chamadosPorDia).length > 0) {
                const ctx1 = document.getElementById('chamadosDiaChart').getContext('2d');
                new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: Object.keys(chamadosPorDia),
                        datasets: [{
                            label: 'Chamados por Dia',
                            data: Object.values(chamadosPorDia),
                            borderColor: 'blue',
                            backgroundColor: 'rgba(0, 0, 255, 0.1)',
                            borderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.3 // Suaviza a curva
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1, // **Força os valores do eixo Y a serem inteiros**
                                    callback: function(value, index, values) {
                                        return Number.isInteger(value) ? value : null; // Oculta valores quebrados
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.warn("Nenhum dado encontrado para Chamados por Dia.");
            }

            // Gráfico de Barras - Chamados por Setor
            if (Object.keys(chamadosPorSetor).length > 0) {
                const setores = Object.keys(chamadosPorSetor);
                const qtdChamados = Object.values(chamadosPorSetor);

                const ctx2 = document.getElementById('chamadosSetorChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: setores,
                        datasets: [{
                            label: 'Chamados por Setor',
                            data: qtdChamados,
                            backgroundColor: setores.map(() => `hsl(${Math.random() * 360}, 70%, 50%)`),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1, // **Força o gráfico de barras a exibir somente números inteiros**
                                    callback: function(value, index, values) {
                                        return Number.isInteger(value) ? value : null;
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ` ${context.raw} chamados`;
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.warn("Nenhum dado encontrado para Chamados por Setor.");
            }
        });
    </script>
</x-app-layout>
