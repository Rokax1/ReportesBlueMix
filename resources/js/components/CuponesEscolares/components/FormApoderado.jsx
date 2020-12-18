import React, { useEffect, useState } from 'react';
import Select from 'react-select';
import { getComunas } from '../services/getComunas';

const options = [
    { value: 'chocolate', label: 'Chocolate' },
    { value: 'strawberry', label: 'Strawberry' },
    { value: 'vanilla', label: 'Vanilla' }
]




const FormApoderado = (props) => {



    return (
        <form>

            <hr />
            <div className="form-row">
                <div className="form-group col-md-4">
                    <label htmlFor="inputEmail4">Nombres</label>
                    <input type="text" className="form-control" />
                </div>
                <div className="form-group col-md-4">
                    <label htmlFor="inputPassword4">Apellido Paterno</label>
                    <input type="text" className="form-control" />
                </div>
                <div className="form-group col-md-4">
                    <label htmlFor="inputAddress">Apellido Materno</label>
                    <input type="text" className="form-control" />
                </div>
            </div>

            <div className="form-row">
                <div className="form-group col-md-6">
                    <label htmlFor="inputAddress2">Correo</label>
                    <input type="email" className="form-control" />
                </div>
                <div className="form-group col-md-6">
                    <label htmlFor="inputCity">Telefono</label>
                    <input type="number" className="form-control" />
                </div>
            </div>

            <div className="form-row">
                <div className="form-group col-md-4">
                    <label htmlFor="inputState">Comuna</label>

                    < Select
                        className="basic-single"
                        classNamePrefix="select"
                        defaultValue={props.SelectComunas[0]}
                        isDisabled={false}
                        isLoading={false}
                        isClearable={true}
                        isRtl={false}
                        isSearchable={true}
                        name="color"
                        options={props.SelectComunas}
                    />



                </div>
                <div className="form-group col-md-8">
                    <label htmlFor="inputZip">Direccion</label>
                    <input type="text" className="form-control" id="inputZip" />
                </div>

            </div>


        </form>

    );
}

export default FormApoderado;
