import FeaturesContext from './FeaturesContext';
import { useContext } from 'react';

const useFeatures = () => {
  const { features } = useContext(FeaturesContext);
  return features;
};
export default useFeatures;
