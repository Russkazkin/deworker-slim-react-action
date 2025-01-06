import React, { ReactNode, useContext } from 'react';
import FeaturesContext from './FeaturesContext';

type Props = {
  children: ReactNode;
  name: string;
  not?: boolean;
};

const FeatureFlag: React.FC<Props> = ({ name, not = false, children }) => {
  const { features } = useContext(FeaturesContext);
  const isActive = features.includes(name);
  return (not ? !isActive : isActive) ? children : null;
};
export default FeatureFlag;
