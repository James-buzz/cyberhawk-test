import React, { useEffect, useMemo } from "react";
import PropTypes from "prop-types";
import useInspectionService from "../hooks/services/useInspectionService";
import useTurbineService from "../hooks/services/useTurbineService";
import { Link, useParams } from "react-router-dom";
import useComponentService from "../hooks/services/useComponentService";
import useGradeService from "../hooks/services/useGradeService";
import useComponentTypeService from "../hooks/services/useComponentTypeService";
import useGradeTypeService from "../hooks/services/useGradeTypeService";

const Inspection = () => {
    let { inspectionID } = useParams();

    const {
        inspection,
        show: inspectionsShow,
        loading: inspectionsLoading,
        error: inspectionsError,
    } = useInspectionService();
    const {
        turbine,
        show: turbinesShow,
        loading: turbinesLoading,
        error: turbinesError,
    } = useTurbineService();
    const {
        components,
        index: componentsIndex,
        loading: componentsLoading,
        error: componentsError,
    } = useComponentService();
    const {
        grades,
        index: gradesIndex,
        loading: gradesLoading,
        error: gradesError,
    } = useGradeService();
    const {
        componentTypes,
        index: componentTypesIndex,
        loading: componentTypesLoading,
        error: componentTypesError,
    } = useComponentTypeService();
    const {
        gradeTypes,
        index: gradeTypesIndex,
        loading: gradeTypesLoading,
        error: gradeTypesError,
    } = useGradeTypeService();

    useEffect(() => {
        inspectionsShow(inspectionID);
        gradesIndex(`inspections/${inspectionID}/`);
        componentTypesIndex();
        gradeTypesIndex();
    }, []);

    useEffect(() => {
        if (inspection && inspection.turbine_id) {
            turbinesShow(inspection.turbine_id);
        }
    }, [inspection]);

    useEffect(() => {
        if (turbine && turbine.id) {
            componentsIndex(`turbines/${turbine.id}/`);
        }
    }, [turbine]);

    const mergeData = () => {
        return components.map((component) => {
            if (grades.length === 0) {
                component = { ...component, grade: null };
            } else {
                let componentGrade = grades.find(
                    (grade) => grade.component_id === component.id
                );

                if (componentGrade) {
                    const gradeType = gradeTypes.find(
                        (type) => type.id === componentGrade.grade_type_id
                    );
                    if (gradeType) {
                        componentGrade = {
                            ...componentGrade,
                            name: gradeType.name,
                        };
                    }
                }

                component = { ...component, grade: componentGrade };
            }

            if (componentTypes.length !== 0) {
                let componentType = componentTypes.find(
                    (type) => type.id === component.component_type_id
                );
                if (componentType) {
                    component = { ...component, name: componentType.name };
                }
            }

            return component;
        });
    };

    const data = useMemo(
        () => mergeData(),
        [grades, components, componentTypes]
    );

    if (inspectionsLoading) return <p>Loading...</p>;
    if (inspectionsError) return <p>Error</p>;

    return (
        <div className="">
            <h1 className="mb-4 text-2xl font-semibold text-gray-900">
                {turbine.name} - {inspection.inspected_at}
            </h1>

            <table className="min-w-full divide-y divide-gray-300">
                <thead className="bg-gray-50">
                    <tr>
                        <th
                            scope="col"
                            className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                        >
                            Component
                        </th>
                        <th
                            scope="col"
                            className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                        >
                            Grade
                        </th>
                    </tr>
                </thead>
                <tbody className="bg-white divide-y divide-gray-200">
                    {data.map((component) => (
                        <tr key={component.id}>
                            <td className="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                {component.name || component.component_type_id}
                            </td>
                            <td className="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {component.grade.name !== null
                                    ? component.grade.name
                                    : "loading"}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

Inspection.propTypes = {};

export default Inspection;
