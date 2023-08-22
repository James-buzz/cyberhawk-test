import React, { useEffect, useMemo } from 'react';
import PropTypes from 'prop-types';
import useTurbineService from '../hooks/services/useTurbineService';
import { Link, useParams } from 'react-router-dom';
import useComponentService from '../hooks/services/useComponentService';
import useInspectionService from '../hooks/services/useInspectionService';
import useComponentTypeService from '../hooks/services/useComponentTypeService';


const Turbine = props => {
    let { turbineID } = useParams();
    const { turbine, show: turbineShow, loading: turbineLoading, error: turbineError} = useTurbineService();
    const { components, index: componentsIndex, loading: componentsLoading, error: componentsError} = useComponentService();
    const { componentTypes, index: componentTypesIndex, loading: componentTypesLoading, error: componentTypesError} = useComponentTypeService();
    const { inspections, index: inspectionsIndex, loading: inspectionsLoading, error: inspectionsError} = useInspectionService();

    useEffect(() => {
        turbineShow(turbineID);
        componentTypesIndex();
        componentsIndex(`turbines/${turbineID}/`);
        inspectionsIndex(`turbines/${turbineID}/`);
    }, [])

    const componentsData = useMemo(() => {
        if(!components || !componentTypes) return [];
        return components.map(component => {
            const componentType = componentTypes.find(componentType => componentType.id === component.component_type_id);
            return { ...component, name: componentType ? componentType.name : '-' };
        });
    }, [components, componentTypes]);


    if(turbineLoading) return <p>Loading...</p>;
    if(turbineError) return <p>Error</p>;

    return (
        <div className="">
            <h1 className="text-2xl font-semibold text-gray-900 mb-4">{turbine.name}</h1>

            <h2 className="mt-4 mb-2">Inspections</h2>

            <table className="min-w-full divide-y divide-gray-300">
                <thead className="bg-gray-50">
                <tr>
                    <th scope="col" className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                        Date Inspected
                    </th>
                    <th scope="col" className="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span className="sr-only">View</span>
                    </th>
                </tr>
                </thead>
                <tbody className="divide-y divide-gray-200 bg-white">
                {inspections.map(inspection => (
                    <tr key={inspection.id}>
                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{inspection.inspected_at}</td>
                        <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <Link to={`/inspections/${inspection.id}`} className="text-indigo-600 hover:text-indigo-900">
                                View<span className="sr-only">, Inspection</span>
                            </Link>
                        </td>
                    </tr>
                ))}

                </tbody>
            </table>

            <h2 className="mt-4 mb-2">Components</h2>

            <table className="min-w-full divide-y divide-gray-300">
                <thead className="bg-gray-50">
                <tr>
                    <th scope="col" className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                        Name
                    </th>
                </tr>
                </thead>
                <tbody className="divide-y divide-gray-200 bg-white">
                {componentsData.map(component => (
                    <tr key={component.id}>
                        <td className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{component.name}</td>
                    </tr>
                ))}

                </tbody>
            </table>
        </div>
    );
};

Turbine.propTypes = {

};

export default Turbine;
