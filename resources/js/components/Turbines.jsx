import React, { useEffect, useMemo } from 'react';
import PropTypes from 'prop-types';
import useTurbineService from '../hooks/services/useTurbineService';
import { Link } from 'react-router-dom';
import useComponentService from '../hooks/services/useComponentService';
import useInspectionService from '../hooks/services/useInspectionService';


const Turbines = props => {
    const { turbines, index: turbinesIndex, loading: turbinesLoading, error: turbinesError} = useTurbineService();
    const { components, index: componentsIndex, loading: componentsLoading, error: componentsError} = useComponentService();
    const { inspections, index: inspectionsIndex, loading: inspectionsLoading, error: inspectionsError} = useInspectionService();

    useEffect(() => {
        turbinesIndex();
        componentsIndex();
        inspectionsIndex();
    }, [])

    const mergeData = () => {
        return turbines.map(turbine => {
            if (components.length === 0) {
                return {...turbine, components: null, inspections: null}
            }
            const turbineComponents = components.filter(component => component.turbine_id === turbine.id);
            const turbineInspections = inspections.filter(inspection => inspection.turbine_id === turbine.id);

            return {...turbine, components: turbineComponents, inspections: turbineInspections};
        });
    }

    const data = useMemo(() => mergeData(), [turbines, components, inspections]);

    if(turbinesLoading) return <p>Loading...</p>;
    if(turbinesError) return <p>Error</p>;

    return (
        <div className="">
            <h1 className="text-2xl font-semibold text-gray-900 mb-4">Turbines</h1>

            <table className="min-w-full divide-y divide-gray-300">
                <thead className="bg-gray-50">
                <tr>
                    <th scope="col" className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                        Name
                    </th>
                    <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                        Component Count
                    </th>
                    <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                        Inspection Count
                    </th>
                    <th scope="col" className="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span className="sr-only">View</span>
                    </th>
                </tr>
                </thead>
                <tbody className="divide-y divide-gray-200 bg-white">
                {data.map(turbine => (
                    <tr key={turbine.id}>
                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{turbine.name}</td>
                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{turbine.components !== null ? turbine.components.length : 'loading'}</td>
                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{turbine.inspections !== null ? turbine.inspections.length : 'loading'}</td>
                        <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <Link to={`/turbines/${turbine.id}`} className="text-indigo-600 hover:text-indigo-900">
                                View<span className="sr-only">, {turbine.name}</span>
                            </Link>
                        </td>
                    </tr>
                ))}

                </tbody>
            </table>
        </div>
    );
};

Turbines.propTypes = {

};

export default Turbines;
