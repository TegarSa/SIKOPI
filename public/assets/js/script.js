document.addEventListener('DOMContentLoaded', async () => {
    const data = await fetch('./assets/js/maps_data.json')
        .then(res => res.json())
        .then(data => data)

    const topology = await fetch(
        'https://code.highcharts.com/mapdata/countries/id/id-all.topo.json'
    ).then(response => response.json())

    Highcharts.mapChart('maps', {
        chart: {
            map: topology,
        },
        title: {
            // text: 'Peta Pendampingan BLUD'
            text: ''
        },
        legend: {
            enabled: false
        },
        mapNavigation: {
            enabled: false,
            buttonOptions: {
                verticalAlign: 'bottom'
            },
            enableDoubleClickZoom: false,
            enableMouseWheelZoom: false,
            enableTouchZoom: false,
            enableDoubleClickZoomTo: false,
        },
        plotOptions: {
            map: {
                allAreas: false,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}',
                },
                tooltip: {
                    pointFormat: `
                <b>{point.name}</b>: <br>
                Jumlah Mitra BLUD : {point.value}
                `
                }
            },
            series: {
                events: {
                    click: e => {
                        const id = e.point['hc-key']
                        const modalDetailIntansce = new bootstrap.Modal('#modal-detail-map')
                        modalDetailIntansce.show()

                        const provinceTitle = document.querySelector('#province-title')
                        const dataMaps = data.filter(item => item.id == id)
                        const province = dataMaps.map(item => item.nama)
                        provinceTitle.innerHTML = `Provinsi ${province[0]}`

                        const tableBody = document.querySelector('#table-detail-map tbody')
                        tableBody.innerHTML = ''
                        dataMaps[0].list_uptd.map((item, i) => {
                            tableBody.innerHTML += `
                         <tr>
                            <td style="width: 1%; white-space: nowrap;">${++i}</td>
                            <td>${item.nama_uptd}</td>
                            <td>${item.jml_uptd}</td>
                         </tr>
                      `
                        })
                    }
                }
            }
        },

        series: [
            {
                data: getPerWilayah(data, 1),
                name: 'Wilayah 1',
            },
            {
                data: getPerWilayah(data, 2),
                name: 'Wilayah 2',
            },
            {
                data: getPerWilayah(data, 3),
                name: 'Wilayah 3',
            },
            {
                data: getPerWilayah(data, 4),
                name: 'Wilayah 4',
            },
            {
                data: getPerWilayah(data, 5),
                name: 'Wilayah 5',
            },
            {
                data: getPerWilayah(data, 6),
                name: 'Wilayah 6',
            },
        ]
    })
})

const getPerWilayah = (data, wilayah) => data.filter(item => item.wilayah == wilayah).map(item => [item.id, item.jml_kota + item.jml_mitra])
