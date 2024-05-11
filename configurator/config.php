<script>
if (typeof c === 'undefined') {
    let c = {};
}
c.config = {
    'items': {
        'model': {
            'm1.manual' : {
                'props': {
                    'model': 'basic',
                    'acceleration': 9.2,
                    'fuel': 'petrol',
                },
                'sums': {
                    'price': 182900,
                }
            },
            'm1.auto' : {
                'props': {
                    'model': 'm1',
                    'acceleration': 8.9,
                    'fuel': 'petrol',
                },
                'sums': {
                    'price': 192900,
                }
            },
            'm2': {
                'props': {
                    'model': 'm2',
                    'acceleration': 4.9,
                    'fuel': 'petrol',
                },
                'sums': {
                    'price': 234000,
                }
            },

        },
        'variant': {
            'basic': {
                'props': {
                    'variant': 'basic',
                },
            },
            'lux': {
                'props': {
                    'variant': 'lux',
                },
                'sums': {
                    'price': 10000,
                },
                'depends': {
                    'model': ['m1.auto'],
                }
            },
            'black': {
                'sums': {
                    'price': 20000,
                },
                'props': {
                    'variant': 'black',
                },
                'depends': {
                    'model': ['m2'],
                }
            },
        },
        'wheel': {
            '18': {
                'props': {
                    'wheel': 18,
                },
            },
            '19': {
                'props': {
                    'wheel': 19,
                },
                'sums': {
                    'price': 8000,
                },
            },
            '19black': {
                'props': {
                    'wheel': 19,
                },
                'sums': {
                    'price': 16000,
                },
            },
        },
        'color': {
            'white': {
                'props': {
                    'color': 'white',
                },
            },
            'black': {
                'props': {
                    'color': 'black',
                },
                'sums': {
                    'price': 10000,
                },
            },
            'red': {
                'props': {
                    'color': 'red',
                },
                'sums': {
                    'price': 20000,
                },
                'depends': {
                    'model': ['m2'],
                }
            },
        },
        'interior': {
            'leather': {
                'props': {
                    'interior': 'leather',
                },
                'sums': {
                    'price': 10000,
                },
            },
            'sport': {
                'props': {
                    'interior': 'sport',
                },
                'sums': {
                    'price': 20000,
                },
                'depends': {
                    'model': ['m2'],
                },
            },
        },
        'panorama': {
            'panorama': {
                'props': {
                    'panorama': 'panorama',
                },
                'sums': {
                    'price': 7000,
                },
                'depends': {
                    'model': ['m1.auto', 'm2'],
                },
            },
        },
    },
};
</script>

