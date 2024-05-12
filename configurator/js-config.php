<script>
if (typeof c === 'undefined') {
    let c = {};
}
c.config = {
    'item': [
        {
            'key': 'model',
            'val': 'm1.manual',
            'prop': {
                'model': 'm1',
                'acceleration': 9.2,
                'fuel': 'petrol',
                'gearbox': 'manual',
            },
            'sum': {
                'price': 182900,
            }
        },
        {
            'key': 'model',
            'val': 'm1.auto',
            'prop': {
                'model': 'm1',
                'acceleration': 8.9,
                'fuel': 'petrol',
                'gearbox': 'auto',
            },
            'sum': {
                'price': 192900,
            }
        },
        {
            'key': 'model',
            'val': 'm2',
            'prop': {
                'model': 'm2',
                'acceleration': 4.9,
                'fuel': 'petrol',
                'gearbox': 'auto',
            },
            'sum': {
                'price': 234000,
            }
        },
        {
            'key': 'variant',
            'val': 'basic',
            'basic': {
                'prop': {
                    'variant': 'basic',
                },
            },
        },
        {
            'key': 'variant',
            'val': 'lux',
            'prop': {
                'variant': 'lux',
            },
            'sum': {
                'price': 10000,
            },
            'depends': {
                'model': ['m1.auto'],
            }
        },
        {
            'key': 'color',
            'val': 'black',
            'sum': {
                'price': 20000,
            },
            'prop': {
                'variant': 'black',
            },
            'depends': {
                'model': ['m2'],
            }
        },
        {
            'key': 'wheel',
            'val': '18',
            'prop': {
                'wheel': 18,
            },
        },
        {
            'key': 'wheel',
            'val': '19',
            'prop': {
                'wheel': 19,
            },
            'sum': {
                'price': 8000,
            },
        },
        {
            'key': 'wheel',
            'val': '19black',
            'prop': {
                'wheel': 19,
            },
            'sum': {
                'price': 16000,
            },
        },
        {
            'key': 'color',
            'val': 'white',
            'prop': {
                'color': 'white',
            },
        },
        {
            'key': 'color',
            'val': 'black',
            'prop': {
                'color': 'black',
            },
            'sum': {
                'price': 10000,
            },
        },
        {
            'key': 'color',
            'val': 'red',
            'prop': {
                'color': 'red',
            },
            'sum': {
                'price': 20000,
            },
            'depends': {
                'model': ['m2'],
            }
        },
        {
            'key': 'interior',
            'val': 'leather',
            'prop': {
                'interior': 'leather',
            },
            'sum': {
                'price': 10000,
            },
        },
        {
            'key': 'interior',
            'val': 'sport',
            'prop': {
                'interior': 'sport',
            },
            'sum': {
                'price': 20000,
            },
            'depends': {
                'model': ['m2'],
            },
        },
        {
            'key': 'panorama',
            'val': 'panorama',
            'prop': {
                'panorama': 'panorama',
            },
            'sum': {
                'price': 7000,
            },
            'depends': {
                'model': ['m1.auto', 'm2'],
            },
        },
    ],
};
</script>

