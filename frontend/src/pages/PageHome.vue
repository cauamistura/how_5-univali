<template>
    <div class="container-home">
        <div class="tabs is-small">
            <ul>
                <li :class="{ 'is-active': activeTab === Tab.Disponivel }" @click="changeTab(Tab.Disponivel)">
                    <a>Disponivel</a></li>
                <li :class="{ 'is-active': activeTab === Tab.Indisponivel }" @click="changeTab(Tab.Indisponivel)">
                    <a>Indisponivel</a></li>
                <li :class="{ 'is-active': activeTab === Tab.Todos }" @click="changeTab(Tab.Todos)"><a>Todos</a></li>
            </ul>
        </div>
        <grid-home-produtos :filtro="activeTab" :dados="this.produtos"/>
    </div>
</template>

<script>
import GridHomeProdutos from '@/components/grids/GridHomeProdutos.vue';

const Tab = {
    Disponivel: 'Disponivel',
    Indisponivel: 'Indisponivel',
    Todos: 'Todos'
};

export default {
    components: {
        GridHomeProdutos
    },
    data() {
        return {
            activeTab: Tab.Disponivel,
            produtos: []
        };
    },
    methods: {
        changeTab(tab) {
            this.activeTab = tab;
        }
    },
    computed: {
        Tab() {
            return Tab;
        }
    }
};
</script>

<style></style>