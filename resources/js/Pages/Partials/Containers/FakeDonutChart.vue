    <script setup lang="ts">
    import { DonutChart } from '@/components/ui/chart-donut'

    const data = [
        {
            name: 'Friva',
            total: Math.floor(Math.random() * 2000) + 500,
        },
        {
            name: 'Rituals',
            total: Math.floor(Math.random() * 2000) + 500,
        },
        {
            name: 'Gemeente Rotterdam',
            total: Math.floor(Math.random() * 2000) + 500,
        },
        {
            name: 'Bol.com',
            total: Math.floor(Math.random() * 2000) + 500,
        }
    ]

    const valueFormatter = (tick: number) => typeof tick === 'number' ? `$ ${new Intl.NumberFormat('us').format(tick).toString()}` : '';
    </script>
    <template>
        <DonutChart
            category="total"
            :data="data"
            :value-formatter="valueFormatter"
            :colors="['#000000', '#222222', '#444444', '#666666', '#888888']"
         index="name"/>
    </template>
