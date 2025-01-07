import React, { ReactNode } from 'react';
import { useFeatures } from './index';

type Props = {
  children: ReactNode;
  name: string;
  not?: boolean;
};

const FeatureFlag: React.FC<Props> = ({ name, not = false, children }) => {
  const features = useFeatures();
  const isActive = features.includes(name);
  return (not ? !isActive : isActive) ? children : null;
};
export default FeatureFlag;
