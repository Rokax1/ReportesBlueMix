import React, { Fragment } from 'react';
import { useParams } from 'react-router-dom';
import { getProductoService } from '../components/MovimientoDeMercaderia/services/getProductoServices';
import {Provider} from 'react-redux';



const MovimientoDeMercaderia = () => {

    React.useEffect(() =>{

    })


    const ObtenerProductos = async () =>{

    }


    return (

        <Provider>
        <div className="container my-4">
            <h1 className="display-6">Movimiento De Mercaderia</h1>
            <hr />
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-wrapping">Buscar</span>
                </div>
                <input type="text" class="form-control" placeholder="Productos" aria-label="Productos" aria-describedby="addon-wrapping" />
            </div>
            <hr />
            <section className="content">
                <div className="card">
                    <div className="card-header">
                        <h3 className="card-title">Articulos</h3>

                    </div>
                    <div class="card-body">
                        <div id="jsGrid1"></div>

                    </div>
                </div>
            </section>
        </div>
        </Provider>


    );
};

export default MovimientoDeMercaderia;
