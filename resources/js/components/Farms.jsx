import React, { useEffect, useMemo } from 'react';
import PropTypes from 'prop-types';
import useFarmService from '../hooks/services/useFarmService';
import useTurbineService from '../hooks/services/useTurbineService';
import { Link } from 'react-router-dom';


const Farms = props => {
    const { farms, index: farmsIndex, loading: farmsLoading, error: farmsError} = useFarmService();
    const { turbines, index: turbinesIndex, loading: turbinesLoading, error: turbinesError} = useTurbineService();

    useEffect(() => {
        farmsIndex();
        turbinesIndex();
    }, [])

    const mergeData = () => {
        return farms.map(farm => {
            if (turbines.length === 0) {
                return {...farm, turbines: null};
            }
            const farmTurbines = turbines.filter(turbine => turbine.farm_id === farm.id);
            return {...farm, turbines: farmTurbines};
        });
    }

    const data = useMemo(() => mergeData(), [farms, turbines]);

    if(farmsLoading) return <p>Loading...</p>;
    if(farmsError) return <p>Error</p>;



    return (
        <div className="">
            <h1 className="text-2xl font-semibold text-gray-900 mb-4">Wind Farms</h1>

            <table className="min-w-full divide-y divide-gray-300">
                <thead className="bg-gray-50">
                <tr>
                    <th scope="col" className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                        Name
                    </th>
                    <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                        Turbine Count
                    </th>
                    <th scope="col" className="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span className="sr-only">View</span>
                    </th>
                </tr>
                </thead>
                <tbody className="divide-y divide-gray-200 bg-white">
                {data.map(farm => (
                    <tr key={farm.id}>
                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{farm.name}</td>
                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{farm.turbines !== null ? farm.turbines.length : 'loading'}</td>
                        <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <Link to={`/farms/${farm.id}`} className="text-indigo-600 hover:text-indigo-900">
                                View<span className="sr-only">, {farm.name}</span>
                            </Link>
                        </td>
                    </tr>
                ))}

                </tbody>
            </table>
        </div>
    );
};

Farms.propTypes = {

};

export default Farms;
