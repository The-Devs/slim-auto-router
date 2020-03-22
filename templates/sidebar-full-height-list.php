<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <?php call_head( "admin-app" ); ?>
        
    </head>

    <body>

        <div
            id="app"
            class="d-flex"
        >
            <!-- Sidebar full Height -->
            <?php call_sidebar( "admin-app" ); ?>

            <!-- Main scrollable max-height:full Height -->
            <main class="p-2 py-5 w-100">
                <div class="text-center">
                    <h2 class="my-4 text-uppercase text-primary">
                        <?php echo $current[ "title" ]; ?>
                    </h2>
                </div>
                <div class="d-flex p-2 justify-content-around">
                    <div class="my-auto">
                        <label>
                            <small>
                                Buscar por
                            </small>
                            <select
                                v-model="search.fieldName"
                                style="width: 10em;"
                                class="form-control"
                                v-on:change="selectHandler"
                            >
                                <option value=""></option>
                                <option
                                    v-for="option in search.options"
                                    :value="option.value"
                                >{{ option.label }}</option>
                            </select>
                        </label>
                    </div>
                    <div class="my-auto">
                        <label>
                            <small>
                                Valor a buscar
                            </small>
                            <input
                                id="searchValue"
                                v-model="search.value"
                                class="form-control"
                                :disabled="!search.fieldName"
                                v-on:keyup="fetchFiltered"
                            />
                        </label>
                    </div>
                    <div class="my-auto">
                        <div class="d-flex flex-column">
                            <label class="mx-auto">
                                <span class="text-primary">
                                    <i
                                        v-if="search.pagination"
                                        class="fas fa-lg fa-toggle-on"
                                    ></i>
                                    <i
                                        v-if="!search.pagination"
                                        class="fas fa-lg fa-toggle-off"
                                    ></i>
                                </span>
                                <span>
                                    Separar resultados por páginas
                                </span>
                                <input
                                    v-model="search.pagination"
                                    v-on:change="fetchFiltered"
                                    type="checkbox"
                                    class="d-none"
                                >
                            </label>
                            
                            <label
                                :class="( search.pagination ? 'visible' : 'invisible' ) + ' d-flex justify-content-end'"
                            >
                                <div class="mr-2">
                                    <small class="d-block">
                                        Resultados
                                    </small>
                                    <small class="d-block">
                                        por página
                                    </small>
                                </div>
                                <div
                                    class="mx-1 my-auto"
                                >
                                    <input
                                        v-model="search.perPage"
                                        type="number"
                                        min="1"
                                        style="width: 4em"
                                    />
                                </div>
                                <button
                                    class="btn  mx-2 rounded-circle"
                                    v-on:click="fetchFiltered"
                                >
                                    <i class="fas fa-xs fa-redo"></i>
                                </button>
                            </label>
                            
                        </div>
                    </div>
                </div>
                <div>
                    <p v-if="loading">
                        <span>
                            <i class="fas fa-spinner fa-pulse"></i>
                        </span>
                        <span class="mx-1">
                            Carrengando...
                        </span>
                    </p>
                    <ul v-if="!loading" class="list-group my-3">
                        <div class="d-flex my-2">
                            <div class="ml-3">
                                <span>
                                    <i class="fas fa-search"></i>
                                </span>
                                <span class="mx-1">
                                    {{ list.length > 0 ? maxDataSize : 'Sem' }} Registros
                                </span>
                            </div>
                            <div
                                v-show="search.pagination"
                                class="mx-auto pagination"
                            >
                                <span
                                    class="page-item"
                                >
                                    <span
                                        name="previous"
                                        v-on:click="paginationNav"
                                        :class="'page-link' + ( this.search.page == 1 ? ' disabled text-muted': '' )"
                                    >Anterior</span>
                                </span>
                                <span
                                    v-for="p in search.maxPages"
                                    :class="'page-item' + ( search.page === p ? ' active' : '' )"
                                >
                                    <span
                                        v-on:click="setPage( p )"
                                        class="page-link"
                                    >{{ p }}</span>
                                </span>
                                <span
                                    name="next"
                                    v-on:click="paginationNav"
                                    :class="'page-link' + ( this.search.page == this.search.maxPages ? ' disabled text-muted': '' )"
                                >Próxima</span>
                            </div>
                        </div>
                        <li
                            v-if="list.length > 0"
                            class="list-group-item d-flex justify-content-around bg-secondary text-sContrast"
                        >
                            <?php foreach( $current[ "request" ][ "fields" ] as $fieldName => $label ): ?>
                                <span class=""><?php echo $label; ?></span>
                            <?php endforeach; ?>
                        </li>
                        <li
                            v-if="list.length > 0"
                            v-for="item in list"
                            class="list-group-item"
                        >
                            <a
                                :href="'<?php echo $current[ "url" ] ?>/' + item.id"
                                class="m-0 d-flex justify-content-around no-decorate"
                            >
                                <?php foreach( $current[ "request" ][ "fields" ] as $fieldName => $label ): ?>
                                    <span class="m-auto">
                                        {{ item.<?php echo $fieldName; ?> }}
                                    </span>
                                <?php endforeach; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </main>
        </div>
        <script>
            const requestUrl = "/admin-app/crud/<?php echo $current[ "request" ][ "param" ]; ?>";
            new Vue( {
                el: "#app",
                data: {
                    nav: <?php echo json_encode( $nav ); ?>,
                    list: [],
                    maxDataSize: null,
                    search: {
                        options: <?php foreach( $current[ "request" ][ "fields" ] as $fieldName => $label ) {
                            $options[] =  [ "value" => $fieldName, "label" => $label ];
                        }
                        echo json_encode( $options ); ?>,
                        fieldName: "",
                        value: "",
                        pagination: true,
                        perPage: 5,
                        maxPages: 1,
                        page: 1,
                    },
                    loading: true,
                },
                methods: {
                    fetchData: function ( url ) {
                        axios.get( url )
                        .then( res => {
                            this.list = res.data.data;
                            this.page = res.data.page;
                            if ( this.search.pagination ) {
                                const maxSize = res.data.maxDataSize;
                                this.maxDataSize = maxSize;
                                const maxPages = parseInt( maxSize / this.search.perPage ) + ( maxSize % this.search.perPage === 0 ? 0: 1);
                                this.search.maxPages = maxPages;
                            }
                        } )
                        .catch( err => {
                            console.warn( err );
                        } )
                        .finally( () => {
                            this.loading = false;
                        } );
                    },
                    fetchFiltered: function ( ev = null ) {
                        let queryParams = {}
                        if ( this.search.pagination ) {
                            queryParams[ "page" ] = this.search.page;
                            queryParams[ "perPage" ] = this.search.perPage;
                        }
                        if ( this.search.fieldName !== "" ) {
                            queryParams[ this.search.fieldName ] = this.search.value;
                            queryParams[ "qType" ] = "like";
                        } else {
                            this.search.value = "";
                        }
                        let urlPairs = [];
                        for ( let key in queryParams ) {
                            urlPairs.push( key + "=" + queryParams[ key ] );
                        }
                        const urlParams = "?" + urlPairs.join( "&" );
                        this.fetchData( requestUrl + urlParams );
                    },
                    setPage: function ( page ) {
                        this.search.page = page;
                        this.fetchFiltered();
                    },
                    focusOnSearchValue: function () {
                        const target = document.querySelector( "#searchValue" );
                        target.focus();
                    },
                    selectHandler: function ( ev ) {
                        const val = ev.target.value;
                        if ( val === "" ) {
                            this.search.value = "";
                            this.fetchFiltered();
                        }
                    },
                    paginationNav: function ( ev ) {
                        const name = ev.target.getAttribute( "name" );
                        switch ( name ) {
                            case "previous":
                                if ( this.search.page > 1 ) {
                                    this.setPage( this.search.page - 1 );
                                }
                                break;
                            case "next":
                                if ( this.search.page < this.search.maxPages ) {
                                    this.setPage( this.search.page + 1 );
                                }
                                break;
                            default:
                                break;
                        }
                    },
                },
                mounted: function () {
                    this.fetchFiltered( requestUrl );
                },
                watch: {}
            } );
        </script>
    </body>
</html>
