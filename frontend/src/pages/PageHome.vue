<template>
    <!-- <div>
        <span>disponivel</span>
        <span>Coxinha</span>
        <span>Preço: R$ 5,00</span>
        <span>Quantidade: 10</span>
        <span>Efetuar pedido</span>
    </div> -->
    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Nome</th>
                <th>Preço</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <figure class="image is-2by1">
                        <img src="https://www.andy-cooks.com/cdn/shop/articles/20240125204816-andy-20cooks-20-20coxinha.jpg?v=1706215806"
                            alt="">
                    </figure>
                </td>
                <td class="td-50px">
                    <div class="disponivel">
                        <span class="icon is-small is-right">
                            <i class="fa fa-check"></i>
                        </span>
                        <span>Disponivel</span>
                    </div>
                </td>
                <td>Coxinha</td>
                <td>R$ 5,00</td>
                <td>+ 1 -</td>
                <td class="td-50px">
                    <button class="button is-primary">Efetuar</button>
                </td>
            </tr>
            <tr>
                <td>Primary row</td>
                <td>Two</td>
                <td>Three</td>
                <td>Four</td>
                <td>Five</td>
                <td class="td-50px">
                    <button class="button is-primary">Efetuar</button>
                </td>
            </tr>

        </tbody>
    </table>
</template>

<script>

export default {}
</script>

<style>
.image {
    margin: 0 auto;
    display: block;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 0 0 1px rgba(10, 10, 10, 0.1);
}

.disponivel {
    border-radius: 5px;
    width: 120px;
    background-color: #EBFFF1;
    color: green;
    padding: 5px;
    font-size: 14px;
}

.disponivel span {
    margin: 4px;
    overflow: hidden;
}

.td-50px {
    max-width: 50px;
}

.table td {
    vertical-align: inherit;
}

</style>